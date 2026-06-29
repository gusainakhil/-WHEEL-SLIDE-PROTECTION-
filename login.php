<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Wheel Slide Protection System (WSPS)</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        :root {
            --wsps-primary: #0B4F8A;
            --wsps-primary-hover: #083c6b;
            --wsps-secondary: #2F6DA6;
            --wsps-bg: #F4F6F9;
            --wsps-text-main: #1E293B;
            --wsps-text-muted: #64748B;
            --font-family: 'Inter', sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--wsps-bg);
            font-family: var(--font-family);
            color: var(--wsps-text-main);
            overflow: hidden;
        }

        .login-container {
            width: 100%;
            height: 100vh;
            display: flex;
            background: #fff;
        }

        /* Left Side: Branding */
        .login-left {
            flex: 1.2;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 50px;
            position: relative;
            overflow: hidden;
        }

        /* Graphic grid background overlay */
        .login-left::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 30px 30px;
            pointer-events: none;
        }

        .brand-header {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-logo-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--wsps-primary), var(--wsps-secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #fff;
            box-shadow: 0 4px 12px rgba(11, 79, 138, 0.3);
        }

        .brand-title-text h1 {
            margin: 0;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: 1px;
            color: #F8FAFC;
        }

        .brand-title-text small {
            font-size: 10px;
            font-weight: 600;
            color: #94A3B8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .brand-body {
            max-width: 480px;
            margin: auto 0;
        }

        .brand-body h2 {
            font-size: 28px;
            font-weight: 800;
            line-height: 1.25;
            margin-bottom: 15px;
            color: #F8FAFC;
        }

        .brand-body p {
            color: #94A3B8;
            font-size: 13.5px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 18px;
        }

        .feature-icon {
            color: #38bdf8;
            font-size: 18px;
            line-height: 1;
            margin-top: 2px;
        }

        .feature-text strong {
            display: block;
            font-size: 13px;
            color: #F8FAFC;
            font-weight: 600;
        }

        .feature-text span {
            font-size: 11.5px;
            color: #94A3B8;
        }

        .brand-footer {
            font-size: 11px;
            color: #64748B;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 20px;
        }

        /* Right Side: Login Form */
        .login-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background-color: #fff;
        }

        .login-form-wrapper {
            width: 100%;
            max-width: 380px;
        }

        .login-form-header h3 {
            font-size: 22px;
            font-weight: 800;
            color: var(--wsps-primary);
            margin-bottom: 6px;
        }

        .login-form-header p {
            font-size: 13px;
            color: var(--wsps-text-muted);
            margin-bottom: 25px;
        }

        .form-group-custom {
            margin-bottom: 18px;
            position: relative;
        }

        .form-label-custom {
            font-size: 11px;
            font-weight: 700;
            color: var(--wsps-text-muted);
            text-transform: uppercase;
            margin-bottom: 6px;
            display: block;
        }

        .input-group-custom {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 12px;
            color: var(--wsps-text-muted);
            font-size: 14px;
            pointer-events: none;
        }

        .form-control-custom {
            height: 38px;
            font-size: 12.5px;
            border: 1px solid #CBD5E1;
            border-radius: 6px;
            padding: 0 12px 0 36px;
            color: var(--wsps-text-main);
            background-color: #fff;
            transition: all 0.2s;
            width: 100%;
            outline: none;
        }

        .form-control-custom:focus {
            border-color: var(--wsps-secondary);
            box-shadow: 0 0 0 3px rgba(47, 109, 166, 0.15);
        }

        .btn-toggle-password {
            position: absolute;
            right: 12px;
            border: none;
            background: none;
            color: var(--wsps-text-muted);
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            height: 100%;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 11.5px;
            margin-bottom: 20px;
        }

        .form-check-input-custom {
            cursor: pointer;
        }

        .form-check-label-custom {
            cursor: pointer;
            color: var(--wsps-text-main);
        }

        .btn-wsps-login {
            width: 100%;
            height: 40px;
            background-color: var(--wsps-primary);
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.2s;
        }

        .btn-wsps-login:hover {
            background-color: var(--wsps-primary-hover);
        }

        .alert-demo-info {
            background: #FAFBFD;
            border: 1px dashed #CBD5E1;
            border-radius: 6px;
            padding: 10px 12px;
            margin-top: 25px;
            font-size: 11.5px;
            color: var(--wsps-text-muted);
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .alert-demo-info i {
            color: var(--wsps-secondary);
            font-size: 14px;
            margin-top: 2px;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .login-left {
                display: none;
            }
            .login-right {
                flex: 1;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <!-- Left Side: Branding -->
        <div class="login-left">
            <div class="brand-header">
                <div class="brand-logo-icon">
                    <i class="bi bi-shield-fill-check"></i>
                </div>
                <div class="brand-title-text">
                    <h1>WHEEL SLIDE PROTECTION SYSTEM</h1>
                    <small>Indian Railways Enterprise Panel</small>
                </div>
            </div>

            <div class="brand-body">
                <h2>Active Axle Protection & Telemetry Control</h2>
                <p>WSPS is a safety-critical real-time microcode monitoring system designed to prevent wheel lockups, flat spots, and speed sensor signal degradations across LHB and ICF rakes.</p>

                <div class="feature-list">
                    <div class="feature-item">
                        <i class="bi bi-shield-fill-check feature-icon"></i>
                        <div class="feature-text">
                            <strong>Automated Solenoid Exhaust Control</strong>
                            <span>Real-time pneumatic dump valve pulse-width diagnostics.</span>
                        </div>
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-broadcast-pin feature-icon"></i>
                        <div class="feature-text">
                            <strong>Micro-current Sensor Monitoring</strong>
                            <span>Live signal strength, frequency, and calibration offsets telemetry.</span>
                        </div>
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-shield-slash feature-icon"></i>
                        <div class="feature-text">
                            <strong>Real-time Slide Diagnostics</strong>
                            <span>Interactive visual axle grid monitoring and wet-rail protection logs.</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="brand-footer">
                &copy; 2026 Wheel Slide Protection System (WSPS) | Ministry of Railways, Govt. of India.
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="login-right">
            <div class="login-form-wrapper">
                <div class="login-form-header">
                    <h3>System Access Panel</h3>
                    <p>Enter your authorization credentials to sign in</p>
                </div>

                <!-- Simulation error message container -->
                <div id="errorAlert" style="display: none;" class="alert alert-danger py-2 mb-3" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-1"></i>
                    <span id="errorMsg" style="font-size: 11.5px;">Invalid username or password.</span>
                </div>

                <form onsubmit="handleLoginSubmit(event)" class="login-form">
                    <div class="form-group-custom">
                        <label for="username" class="form-label-custom">Username / Operator ID</label>
                        <div class="input-group-custom">
                            <i class="bi bi-person input-icon"></i>
                            <input 
                                type="text" 
                                class="form-control-custom" 
                                id="username" 
                                placeholder="e.g., USR-001" 
                                required
                            >
                        </div>
                    </div>

                    <div class="form-group-custom">
                        <label for="password" class="form-label-custom">Security Password</label>
                        <div class="input-group-custom">
                            <i class="bi bi-lock input-icon"></i>
                            <input 
                                type="password" 
                                class="form-control-custom" 
                                id="password" 
                                placeholder="••••••••" 
                                required
                            >
                            <button type="button" class="btn-toggle-password" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input-custom" id="rememberMe">
                            <label class="form-check-label-custom" for="rememberMe">Remember Session</label>
                        </div>
                        <a href="#" class="text-decoration-none" style="color: var(--wsps-secondary); font-weight: 600;">Forgot Pin?</a>
                    </div>

                    <button type="submit" class="btn-wsps-login">
                        <i class="bi bi-box-arrow-in-right"></i> Authenticate Session
                    </button>
                </form>

                <div class="alert-demo-info">
                    <i class="bi bi-info-circle-fill"></i>
                    <div>
                        <strong>Section Operator Demo Access</strong>
                        <div class="mt-1">Use <code>se-operator</code> / <code>123456</code> to access the dashboard.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            const icon = this.querySelector('i');
            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        });

        // Handle Login Submission
        function handleLoginSubmit(event) {
            event.preventDefault();
            const user = document.getElementById('username').value.trim();
            const pass = document.getElementById('password').value;
            const errorAlert = document.getElementById('errorAlert');
            const errorMsg = document.getElementById('errorMsg');

            if (user === 'se-operator' && pass === '123456') {
                errorAlert.style.display = "none";
                // Redirecting directly to dashboard
                window.location.href = "index.php";
            } else {
                errorMsg.textContent = "Invalid username or password. Please use se-operator / 123456 for demo access.";
                errorAlert.style.display = "block";
            }
        }
    </script>
</body>
</html>
