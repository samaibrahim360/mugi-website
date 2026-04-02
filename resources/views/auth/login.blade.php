<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mugi</title>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Cherry+Bomb+One&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-cream: #F4F1EA;
            --olive: #A3B18A;
            --olive-dark: #588157;
            --soft-pink: #FBB6CE;
            --hot-pink: #EF4D8D;
            --dark: #333333;
            --white: #FFFFFF;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-cream);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .auth-container {
            background: var(--white);
            padding: 50px;
            border-radius: 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .auth-title {
            font-family: 'Abril Fatface', cursive;
            font-size: 2.5rem;
            color: var(--olive-dark);
            text-align: center;
            margin-bottom: 10px;
        }
        
        .auth-subtitle {
            text-align: center;
            color: #888;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
        }
        
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--soft-pink);
            border-radius: 10px;
            font-family: inherit;
        }
        
        .auth-btn {
            width: 100%;
            padding: 12px;
            background: var(--olive-dark);
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 10px;
        }
        
        .auth-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .auth-link a {
            color: var(--hot-pink);
            text-decoration: none;
        }
        
        .error {
            color: red;
            font-size: 0.85rem;
            margin-top: 5px;
        }
        
        .alert {
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <h1 class="auth-title">Welcome Back</h1>
        <p class="auth-subtitle">Login to your account</p>
        
        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        
        <form action="/login" method="POST">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            
            <button type="submit" class="auth-btn">Login</button>
        </form>
        
        <div class="auth-link">
            <p>Don't have an account? <a href="/register">Register here</a></p>
        </div>
        
        <div class="auth-link">
            <p><a href="/">← Back to Home</a></p>
        </div>
    </div>
</body>
</html>