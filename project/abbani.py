from flask import Flask, request, jsonify 
from flask_cors import CORS 
from google import generativeai as genai 
import mysql.connector
import re
 
app = Flask(__name__) 
CORS(app) 
 
# Configure your Gemini API key 
genai.configure(api_key="AIzaSyDxPJkpfFPALysQAOPhDHrrAfoSJPzX_6Q") 
model = genai.GenerativeModel("gemini-2.0-flash") 

# PURE DATABASE CONNECTION FUNCTION
def get_db_connection():
    return mysql.connector.connect(
        host="localhost",
        user="root", 
        password="",
        database="skillhub_db"
    )

# CALCULATE AVERAGE RATING FOR A COURSE FROM RATINGS TABLE
def calculate_average_rating(course_id, cursor):
    try:
        print(f"=== DEBUG: Calculating rating for course_id: {course_id} ===")
        cursor.execute("SELECT AVG(rating) as avg_rating FROM ratings WHERE course_id = %s", (course_id,))
        result = cursor.fetchone()
        print(f"=== DEBUG: Raw SQL result: {result} ===")
        
        if result and result['avg_rating'] is not None:
            avg_rating = round(float(result['avg_rating']), 1)
            print(f"=== DEBUG: Calculated average: {avg_rating} ===")
            return avg_rating
        else:
            print(f"=== DEBUG: No ratings found for course_id: {course_id} ===")
            return 0.0
    except Exception as e:
        print(f"=== DEBUG: Exception in calculate_average_rating for course {course_id}: {e} ===")
        return 0.0

# TEST DATABASE CONNECTION
def test_db_connection():
    try:
        conn = get_db_connection()
        cursor = conn.cursor()
        cursor.execute("SELECT COUNT(*) FROM courses")
        count = cursor.fetchone()[0]
        cursor.close()
        conn.close()
        return f"Database connected successfully! Found {count} courses."
    except Exception as e:
        return f"Database connection failed: {e}"

# EXTRACT KEYWORDS FROM USER MESSAGE
def extract_keywords_from_message(message):
    # Split message into words and clean them
    words = re.findall(r'\b\w+\b', message.lower())
    
    # Remove common stop words that don't help with course matching
    stop_words = {'i', 'want', 'a', 'an', 'the', 'for', 'in', 'on', 'at', 'to', 'of', 'and', 'or', 'but', 'is', 'are', 'was', 'were', 'be', 'been', 'have', 'has', 'had', 'do', 'does', 'did', 'will', 'would', 'could', 'should', 'may', 'might', 'can', 'about', 'with', 'from', 'by', 'this', 'that', 'these', 'those', 'some', 'any', 'course', 'courses', 'show', 'me', 'find', 'get', 'give'}
    
    keywords = [word for word in words if word not in stop_words and len(word) > 1]
    return keywords

# CHECK IF MESSAGE IS COURSE-RELATED
def is_course_related_message(message):
    # Course-related keywords that indicate user wants to search for courses
    course_keywords = [
        'course', 'courses', 'learn', 'learning', 'study', 'studying', 'tutorial', 'tutorials',
        'class', 'classes', 'training', 'teach', 'teaching', 'education', 'skill', 'skills',
        'programming', 'development', 'beginner', 'advanced', 'intermediate',
        'python', 'java', 'javascript', 'php', 'c#', 'c++', 'sql', 'html', 'css', 'web',
        'enroll', 'enrollment', 'certificate', 'certification', 'instructor', 'professor'
    ]
    
    message_lower = message.lower()
    
    # Check if any course-related keyword is in the message
    return any(keyword in message_lower for keyword in course_keywords)

# ENHANCED SEARCH FOR SPECIFIC TECHNOLOGIES/TOPICS
def search_courses_by_topic(user_message):
    try:
        conn = get_db_connection()
        cursor = conn.cursor(dictionary=True)
        
        # Extract main technology/topic from user message
        user_input_lower = user_message.lower()
        
        # Define search patterns for common technologies
        search_patterns = []
        search_topic = None
        requested_level = None
        
        # Check for difficulty level in message
        if 'beginner' in user_input_lower or 'basic' in user_input_lower:
            requested_level = 'beginner'
        elif 'intermediate' in user_input_lower or 'medium' in user_input_lower:
            requested_level = 'intermediate'
        elif 'advanced' in user_input_lower or 'expert' in user_input_lower:
            requested_level = 'advanced'
        
        # Java detection (handles: java, Java Programming, java course, etc.)
        if any(word in user_input_lower for word in ['java']):
            # Make sure it's not JavaScript
            if 'javascript' not in user_input_lower and 'js' not in user_input_lower:
                search_patterns = ['%java%']
                search_topic = "Java"
        
        # Python detection  
        elif any(word in user_input_lower for word in ['python', 'py']):
            search_patterns = ['%python%']
            search_topic = "Python"
        
        # JavaScript detection
        elif any(word in user_input_lower for word in ['javascript', 'js']):
            search_patterns = ['%javascript%', '%js%']
            search_topic = "JavaScript"
        
        # PHP detection
        elif any(word in user_input_lower for word in ['php']):
            search_patterns = ['%php%']
            search_topic = "PHP"
        
        # C# detection (handles c#, csharp, c sharp)
        elif any(word in user_input_lower for word in ['c#', 'csharp', 'c sharp']):
            search_patterns = ['%c#%', '%csharp%', '%c sharp%']
            search_topic = "C#"
        
        # C++ detection
        elif any(word in user_input_lower for word in ['c++', 'cpp', 'cplusplus']):
            search_patterns = ['%c++%', '%cpp%', '%cplusplus%']
            search_topic = "C++"
        
        # Add more technologies as needed
        elif any(word in user_input_lower for word in ['sql', 'database']):
            search_patterns = ['%sql%', '%database%']
            search_topic = "SQL/Database"
        
        elif any(word in user_input_lower for word in ['web', 'html', 'css']):
            search_patterns = ['%web%', '%html%', '%css%']
            search_topic = "Web Development"
        
        # If no specific technology found, fall back to keyword search
        if not search_patterns:
            return None
            
        print(f"=== DEBUG: Searching for {search_topic} courses with patterns: {search_patterns}, level: {requested_level} ===")
        
        # Build comprehensive search query
        conditions = []
        params = []
        
        for pattern in search_patterns:
            condition = """(
                LOWER(title) LIKE %s OR 
                LOWER(category) LIKE %s OR 
                LOWER(description) LIKE %s OR
                LOWER(instructor) LIKE %s
            )"""
            conditions.append(condition)
            # Add pattern for each field
            params.extend([pattern] * 4)
        
        # Join all conditions with OR (any pattern match)
        where_clause = ' OR '.join(conditions)
        
        # If user specified a level, add it to the query
        level_clause = ""
        if requested_level:
            level_clause = f" AND LOWER(difficulty) = '{requested_level}'"
        
        # Add relevance scoring - title and category matches score higher
        query = f"""
            SELECT *,
                   (CASE 
                    WHEN LOWER(title) LIKE %s THEN 20
                    WHEN LOWER(category) LIKE %s THEN 15
                    WHEN LOWER(description) LIKE %s THEN 10
                    WHEN LOWER(instructor) LIKE %s THEN 5
                    ELSE 1 
                   END) as relevance_score
            FROM courses 
            WHERE ({where_clause}){level_clause}
            ORDER BY relevance_score DESC, views DESC
        """
        
        # Add scoring parameters (use first pattern for scoring)
        scoring_params = [search_patterns[0]] * 4
        all_params = scoring_params + params
        
        print(f"=== DEBUG: Executing query with params: {all_params} ===")
        
        cursor.execute(query, all_params)
        courses = cursor.fetchall()
        
        # CALCULATE AVERAGE RATING FOR EACH COURSE FROM RATINGS TABLE
        for course in courses:
            course['rating'] = calculate_average_rating(course['id'], cursor)
            print(f"=== DEBUG: Course {course['id']} ({course['title']}) final rating: {course['rating']} ===")
        
        # If no courses found with specific level, get all courses for that technology
        if not courses and requested_level:
            print(f"=== DEBUG: No {requested_level} {search_topic} courses found, searching all levels ===")
            query_all = f"""
                SELECT *,
                       (CASE 
                        WHEN LOWER(title) LIKE %s THEN 20
                        WHEN LOWER(category) LIKE %s THEN 15
                        WHEN LOWER(description) LIKE %s THEN 10
                        WHEN LOWER(instructor) LIKE %s THEN 5
                        ELSE 1 
                       END) as relevance_score
                FROM courses 
                WHERE {where_clause}
                ORDER BY relevance_score DESC, views DESC
            """
            
            cursor.execute(query_all, all_params)
            all_courses = cursor.fetchall()
            
            # CALCULATE AVERAGE RATING FOR EACH ALTERNATIVE COURSE
            for course in all_courses:
                course['rating'] = calculate_average_rating(course['id'], cursor)
            
            cursor.close()
            conn.close()
            
            return courses, search_topic, requested_level, all_courses
        
        cursor.close()
        conn.close()
        
        print(f"=== DEBUG: Found {len(courses)} {search_topic} courses ===")
        return courses, search_topic, requested_level, None
        
    except Exception as e:
        print(f"=== DEBUG: Database error: {e} ===")
        return f"DB Error: {e}", None, None, None

# GENERAL KEYWORD SEARCH (FALLBACK)
def search_courses_by_general_keywords(keywords):
    try:
        conn = get_db_connection()
        cursor = conn.cursor(dictionary=True)
        
        # Build dynamic search query using database content
        search_conditions = []
        params = []
        
        for keyword in keywords:
            # Create LIKE conditions for each relevant field
            condition = """(
                LOWER(title) LIKE %s OR 
                LOWER(description) LIKE %s OR 
                LOWER(category) LIKE %s OR 
                LOWER(difficulty) LIKE %s OR 
                LOWER(instructor) LIKE %s
            )"""
            search_conditions.append(condition)
            # Add the keyword 5 times for each field
            keyword_param = f"%{keyword}%"
            params.extend([keyword_param] * 5)
        
        if search_conditions:
            # Join conditions with AND (all keywords should match somewhere)
            query = f"""
                SELECT *, 
                       (CASE 
                        WHEN LOWER(title) LIKE %s THEN 10
                        WHEN LOWER(category) LIKE %s THEN 8  
                        WHEN LOWER(difficulty) LIKE %s THEN 6
                        WHEN LOWER(description) LIKE %s THEN 4
                        WHEN LOWER(instructor) LIKE %s THEN 2
                        ELSE 1 
                       END) as relevance_score
                FROM courses 
                WHERE {' AND '.join(search_conditions)}
                ORDER BY relevance_score DESC, views DESC
                LIMIT 10
            """
            
            # Add scoring parameters (using first keyword for scoring)
            first_keyword = f"%{keywords[0]}%"
            scoring_params = [first_keyword] * 5
            all_params = scoring_params + params
            
        else:
            # If no keywords, return most popular courses
            query = "SELECT * FROM courses ORDER BY views DESC LIMIT 10"
            all_params = []
        
        cursor.execute(query, all_params)
        courses = cursor.fetchall()
        
        # CALCULATE AVERAGE RATING FOR EACH COURSE FROM RATINGS TABLE
        for course in courses:
            course['rating'] = calculate_average_rating(course['id'], cursor)
        
        cursor.close()
        conn.close()
        return courses
        
    except Exception as e:
        return f"DB Error: {e}"

# GET ALL UNIQUE VALUES FROM DATABASE FOR CONTEXT
def get_database_context():
    try:
        conn = get_db_connection()
        cursor = conn.cursor()
        
        # Get all unique categories
        cursor.execute("SELECT DISTINCT category FROM courses WHERE category IS NOT NULL ORDER BY category")
        categories = [row[0] for row in cursor.fetchall()]
        
        # Get all unique difficulties  
        cursor.execute("SELECT DISTINCT difficulty FROM courses WHERE difficulty IS NOT NULL ORDER BY difficulty")
        difficulties = [row[0] for row in cursor.fetchall()]
        
        # Get all unique instructors
        cursor.execute("SELECT DISTINCT instructor FROM courses WHERE instructor IS NOT NULL ORDER BY instructor")
        instructors = [row[0] for row in cursor.fetchall()]
        
        # Get total courses count
        cursor.execute("SELECT COUNT(*) FROM courses")
        total_courses = cursor.fetchone()[0]
        
        cursor.close()
        conn.close()
        
        return {
            'categories': categories,
            'difficulties': difficulties, 
            'instructors': instructors,
            'total_courses': total_courses
        }
        
    except Exception as e:
        return None

@app.route('/chat', methods=['POST']) 
def chat(): 
    data = request.json 
    message = data.get('message', '') 
    
    print(f"=== DEBUG: Received message: '{message}' ===")
    
    # Test database connection
    if message.lower() == "test db":
        result = test_db_connection()
        return jsonify({'reply': result})
    
    # Try technology-specific search first
    tech_search_result = search_courses_by_topic(message)
    
    if tech_search_result and tech_search_result[0] != None:
        courses, search_topic, requested_level, alternative_courses = tech_search_result
        
        if isinstance(courses, str):  # Error
            return jsonify({'reply': f"Database error: {courses}"})
        
        if courses and len(courses) > 0:
            print(f"=== DEBUG: RETURNING {search_topic} COURSES ===")
            
            level_text = f" {requested_level}" if requested_level else ""
            response = f"Great choice! {search_topic} is an excellent technology to learn. Here are the{level_text} {search_topic} courses we have available on SkillHub:\n\n🎯 Found {len(courses)} {search_topic}-related course(s):\n\n"
            
            for course in courses:
                course_url = f"http://localhost:8000/courses/{course['id']}"
                response += f"📚 {course['title']}\n"
                response += f"👨‍🏫 Instructor: {course['instructor']}\n"
                response += f"📂 Category: {course['category']}\n"
                response += f"📊 Level: {course['difficulty']}\n"
                response += f"⭐ Rating: {course['rating']}/5\n"
                response += f"👁️ Views: {course['views']}\n"
                response += f"🔗 <a href='{course_url}' target='_blank' style='color: #2563eb !important; text-decoration: none !important; font-weight: bold !important; background: linear-gradient(135deg, #e3f2fd, #bbdefb); padding: 10px 20px; border-radius: 25px; display: inline-block; margin: 8px 0; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(37, 99, 235, 0.2); border: 2px solid #2563eb;'>📖 Learn More</a>\n"
                response += f"📝 {course['description']}\n"
                response += f"{'─' * 50}\n\n"  # Separator line
            
            response += f"All {search_topic} courses shown above! Click the **Learn More** buttons to start learning! 🚀"
            return jsonify({'reply': response})
            
        elif requested_level and alternative_courses and len(alternative_courses) > 0:
            # No courses found for requested level, but other levels available
            print(f"=== DEBUG: NO {requested_level} {search_topic} COURSES, OFFERING ALTERNATIVES ===")
            
            # Get available levels for this technology
            available_levels = list(set([course['difficulty'] for course in alternative_courses]))
            levels_text = ", ".join(available_levels)
            
            response = f"I couldn't find any {requested_level} {search_topic} courses, but we do have {search_topic} courses at other levels: {levels_text}.\n\n"
            response += f"Would you like to see the available {search_topic} courses at these levels instead? 🤔\n\n"
            response += f"Just reply with 'yes' to see all our {search_topic} courses, or specify a different level like 'beginner {search_topic}' or 'intermediate {search_topic}'."
            
            return jsonify({'reply': response})
        else:
            print(f"=== DEBUG: NO {search_topic} COURSES FOUND ===")
            
            # Get database context for suggestions
            db_context = get_database_context()
            if db_context:
                suggestions = f"I'd love to help you learn {search_topic}, but we don't have any {search_topic} courses available right now. 😊\n\nHere's what we do have:\n📂 {', '.join(db_context['categories'])}\n\n💡 Try asking about any of these topics!"
                return jsonify({'reply': suggestions})
            else:
                return jsonify({'reply': f"Sorry, we don't have any {search_topic} courses available at the moment."})
    
    # Check for "yes" response to show alternative courses
    if message.lower().strip() in ['yes', 'yeah', 'yep', 'sure', 'ok', 'okay']:
        # This is a simple yes response - we'd need to store context to know what they're saying yes to
        # For now, let's treat this as a general affirmative response
        return jsonify({'reply': "Great! What would you like to learn about? Just tell me the technology or subject you're interested in! 😊"})
    
    # Check if this is a course-related message
    if is_course_related_message(message):
        print("=== DEBUG: COURSE-RELATED MESSAGE DETECTED ===")
        
        # Extract keywords from user message
        keywords = extract_keywords_from_message(message)
        print(f"=== DEBUG: Extracted keywords: {keywords} ===")
        
        # Search courses if keywords found
        if keywords:
            print("=== DEBUG: SEARCHING COURSES WITH GENERAL KEYWORDS ===")
            
            courses = search_courses_by_general_keywords(keywords)
            print(f"=== DEBUG: General search results: {courses} ===")
            
            if isinstance(courses, str):  # Error
                return jsonify({'reply': f"Database error: {courses}"})
            
            if courses and len(courses) > 0:
                print("=== DEBUG: RETURNING GENERAL SEARCH COURSES ===")
                
                response = f"Awesome! I found some great courses that match what you're looking for:\n\n🎯 Found {len(courses)} course(s) matching your search:\n\n"
                
                for course in courses:
                    course_url = f"http://localhost:8000/courses/{course['id']}"
                    response += f"📚 **{course['title']}**\n"
                    response += f"👨‍🏫 Instructor: {course['instructor']}\n"
                    response += f"📂 Category: {course['category']}\n"
                    response += f"📊 Level: {course['difficulty']}\n"
                    response += f"⭐ Rating: {course['rating']}/5\n"
                    response += f"👁️ Views: {course['views']}\n"
                    response += f"🔗 <a href='{course_url}' target='_blank' style='color: #2563eb !important; text-decoration: none !important; font-weight: bold !important; background: linear-gradient(135deg, #e3f2fd, #bbdefb); padding: 10px 20px; border-radius: 25px; display: inline-block; margin: 8px 0; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(37, 99, 235, 0.2); border: 2px solid #2563eb;'>📖 ENROLL NOW</a>\n"
                    response += f"📝 {course['description']}\n"
                    response += f"{'─' * 50}\n\n"  # Separator line
                
                response += "Click any **ENROLL NOW** button to start learning immediately! 🚀"
                return jsonify({'reply': response})
            else:
                print("=== DEBUG: NO MATCHING COURSES FOUND ===")
                
                # Get database context for suggestions
                db_context = get_database_context()
                if db_context:
                    suggestions = f"I couldn't find courses for '{' '.join(keywords)}', but here's what we offer:\n\n"
                    suggestions += f"📂 **Categories:** {', '.join(db_context['categories'])}\n"
                    suggestions += f"📊 **Levels:** {', '.join(db_context['difficulties'])}\n"
                    suggestions += f"👨‍🏫 **Instructors:** {', '.join(db_context['instructors'])}\n"
                    suggestions += f"\n💡 Try searching for any of these topics!"
                    
                    return jsonify({'reply': suggestions})
                else:
                    return jsonify({'reply': "No matching courses found."})
        else:
            # Course-related but no keywords extracted, show general course info
            db_context = get_database_context()
            if db_context:
                response = f"🎓 Welcome to SkillHub! We have {db_context['total_courses']} amazing courses available:\n\n"
                response += f"📂 **Categories:** {', '.join(db_context['categories'])}\n"
                response += f"📊 **Levels:** {', '.join(db_context['difficulties'])}\n"
                response += f"👨‍🏫 **Instructors:** {', '.join(db_context['instructors'])}\n"
                response += f"\n💡 Just tell me what you want to learn! For example: 'python for beginners' or 'advanced javascript'"
                return jsonify({'reply': response})
    
    # Handle casual conversation
    print("=== DEBUG: CASUAL CONVERSATION DETECTED ===")
    
    # Define conversation responses based on message patterns
    message_lower = message.lower().strip()
    
    # Greeting responses
    if any(greeting in message_lower for greeting in ['hi', 'hello', 'hey', 'good morning', 'good afternoon', 'good evening']):
        return jsonify({'reply': "Hey there! 👋 How can I help you today? Looking to learn something new or explore our courses?"})
    
    # How are you responses  
    elif any(phrase in message_lower for phrase in ['how are you', 'how r u', 'whats up', "what's up", 'sup']):
        return jsonify({'reply': "I'm doing great, thanks for asking! 😊 I'm here to help you find amazing courses on SkillHub. What would you like to learn today?"})
    
    # Thank you responses
    elif any(phrase in message_lower for phrase in ['thank you', 'thanks', 'thx', 'ty']):
        return jsonify({'reply': "You're welcome! 🎉 Happy to help! If you need any course recommendations or have questions about learning, just ask!"})
    
    # Help requests
    elif any(phrase in message_lower for phrase in ['help', 'assist', 'support']):
        return jsonify({'reply': "I'd love to help! 💪 I can help you find courses, recommend learning paths, or answer questions about SkillHub. What are you interested in learning?"})
    
    # Goodbye responses
    elif any(phrase in message_lower for phrase in ['bye', 'goodbye', 'see you', 'later', 'exit', 'quit']):
        return jsonify({'reply': "See you later! 👋 Feel free to come back anytime if you want to explore more courses or need learning advice. Happy learning!"})
    
    # General conversation fallback using LLM with SkillHub context
    else:
        try:
            system_prompt = """You are a friendly AI assistant for SkillHub educational platform. 
            You're having a casual conversation with someone. Be friendly, helpful, and naturally guide the conversation toward learning and education when appropriate.
            Keep responses conversational and encouraging. Don't be pushy about courses - just be a helpful friend."""
            
            full_prompt = f"{system_prompt}\n\nUser: {message}"
            response = model.generate_content(full_prompt) 
            return jsonify({'reply': response.text.strip()}) 
            
        except Exception as e: 
            return jsonify({'reply': "I'm here to help! Feel free to ask me about courses or just chat. What's on your mind? 😊"})

if __name__ == "__main__": 
    print("🚀 Starting SkillHub Pure Database-Driven Chatbot...")
    app.run(port=5000, debug=True)