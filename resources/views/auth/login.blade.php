<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            padding: 20px;
        }

        .glass-form {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 20px;
            padding: 50px 45px;
            width: 450px;
            max-width: 100%;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
        }

        .glass-form h2 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 42px;
            font-weight: 700;
            color: #222;
            letter-spacing: 1px;
        }

        .input-group {
            margin-bottom: 25px;
            position: relative;
        }

        .glass-form input[type="email"],
        .glass-form input[type="password"] {
            width: 100%;
            padding: 16px 50px 16px 20px;
            border: 2px solid rgba(0, 0, 0, 0.12);
            border-radius: 50px;
            background: rgba(0, 0, 0, 0.04);
            color: #222;
            font-size: 15px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }

        .glass-form input:focus {
            outline: none;
            background: rgba(102, 126, 234, 0.06);
            border-color: #667eea;
        }

        .glass-form input::placeholder {
            color: rgba(0, 0, 0, 0.4);
            font-weight: 400;
        }

        /* Autofill fix for light background */
        .glass-form input:-webkit-autofill,
        .glass-form input:-webkit-autofill:hover,
        .glass-form input:-webkit-autofill:focus,
        .glass-form input:-webkit-autofill:active {
            -webkit-text-fill-color: #222 !important;
            -webkit-box-shadow: 0 0 0px 1000px rgba(240, 240, 255, 0.95) inset !important;
            transition: background-color 5000s ease-in-out 0s;
            border: 2px solid rgba(0, 0, 0, 0.12) !important;
            caret-color: #222;
        }

        .input-icon {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            pointer-events: none;
        }

        .error {
            color: #e53e3e;
            font-size: 13px;
            margin-top: 8px;
            margin-left: 20px;
        }

        /* Purple gradient button */
        .glass-form button {
            width: 100%;
            padding: 16px;
            margin-top: 15px;
            border: none;
            border-radius: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            font-weight: 600;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }

        .glass-form button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.6);
        }

        .glass-form button:active {
            transform: translateY(0);
        }

        .register-link {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #555;
            font-weight: 400;
        }

        .register-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 500px) {
            .glass-form {
                padding: 40px 25px;
                width: 100%;
            }

            .glass-form h2 {
                font-size: 32px;
                margin-bottom: 30px;
            }

            .glass-form input[type="email"],
            .glass-form input[type="password"] {
                padding: 14px 40px 14px 15px;
                font-size: 14px;
            }

            .glass-form button {
                padding: 14px;
                font-size: 15px;
            }

            .register-link {
                font-size: 13px;
            }
        }

        @media (max-width: 350px) {
            .glass-form {
                padding: 30px 15px;
            }

            .glass-form h2 {
                font-size: 28px;
            }

            .glass-form input[type="email"],
            .glass-form input[type="password"] {
                padding: 12px 35px 12px 12px;
            }

            .glass-form button {
                padding: 12px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="glass-form">
        <h2>Login</h2>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <!-- EMAIL -->
            <div class="input-group">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <span class="input-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="4" width="20" height="16" rx="3" stroke="rgba(0,0,0,0.35)" stroke-width="2"/>
                        <path d="M2 8l10 6 10-6" stroke="rgba(0,0,0,0.35)" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </span>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- PASSWORD -->
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
                <span class="input-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="5" y="11" width="14" height="10" rx="2" stroke="rgba(0,0,0,0.35)" stroke-width="2"/>
                        <path d="M8 11V7a4 4 0 0 1 8 0v4" stroke="rgba(0,0,0,0.35)" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="12" cy="16" r="1.5" fill="rgba(0,0,0,0.35)"/>
                    </svg>
                </span>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            @if ($errors->has('email'))
                <div class="error" style="margin-bottom: 10px;">{{ $errors->first('email') }}</div>
            @endif

            <button type="submit">Login</button>
        </form>

        <div class="register-link">
            Don't have an account? <a href="{{ route('register') }}">Register</a>
        </div>
    </div>
</body>
</html>