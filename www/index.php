<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Docker Service</title>
    <style>
        :root {
            --bg-primary: #0f0f23;
            --bg-secondary: #1a1a2e;
            --text-primary: #e4e4f0;
            --text-secondary: #a0a0b0;
            --accent: #00d9ff;
            --accent-secondary: #ff6b9d;
            --success: #50fa7b;
            --warning: #ffb86c;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'JetBrains Mono', 'Fira Code', 'SF Mono', monospace;
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            background-image: 
                radial-gradient(ellipse at 20% 20%, rgba(0, 217, 255, 0.08) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 80%, rgba(255, 107, 157, 0.08) 0%, transparent 50%),
                linear-gradient(180deg, var(--bg-primary) 0%, var(--bg-secondary) 100%);
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        header {
            text-align: center;
            margin-bottom: 50px;
            animation: fadeInUp 0.8s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .logo {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--accent), var(--accent-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }
        
        .subtitle {
            color: var(--text-secondary);
            font-size: 1.1rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        
        .status-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .card {
            background: rgba(26, 26, 46, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            padding: 25px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            animation: fadeInUp 0.8s ease-out backwards;
        }
        
        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3) { animation-delay: 0.3s; }
        .card:nth-child(4) { animation-delay: 0.4s; }
        
        .card:hover {
            border-color: rgba(0, 217, 255, 0.3);
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }
        
        .card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }
        
        .card-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 1.2rem;
        }
        
        .card-icon.php { background: linear-gradient(135deg, #4F5B93, #8993BE); }
        .card-icon.mysql { background: linear-gradient(135deg, #00758F, #F29111); }
        .card-icon.apache { background: linear-gradient(135deg, #D22128, #252525); }
        .card-icon.server { background: linear-gradient(135deg, var(--accent), var(--accent-secondary)); }
        
        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
        }
        
        .status-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .status-row:last-child {
            border-bottom: none;
        }
        
        .status-label {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }
        
        .status-value {
            color: var(--success);
            font-size: 0.9rem;
        }
        
        .status-value.warning {
            color: var(--warning);
        }
        
        .extensions-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 15px;
        }
        
        .extension-badge {
            background: rgba(0, 217, 255, 0.1);
            border: 1px solid rgba(0, 217, 255, 0.2);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            color: var(--accent);
        }
        
        .quick-links {
            background: rgba(26, 26, 46, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            padding: 25px;
            animation: fadeInUp 0.8s ease-out 0.5s backwards;
        }
        
        .quick-links h2 {
            margin-bottom: 20px;
            font-size: 1.3rem;
        }
        
        .links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .link-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            background: rgba(0, 217, 255, 0.05);
            border: 1px solid rgba(0, 217, 255, 0.1);
            border-radius: 10px;
            text-decoration: none;
            color: var(--text-primary);
            transition: all 0.3s ease;
        }
        
        .link-item:hover {
            background: rgba(0, 217, 255, 0.15);
            border-color: rgba(0, 217, 255, 0.3);
            transform: translateX(5px);
        }
        
        .link-item span {
            font-size: 1.2rem;
        }
        
        footer {
            text-align: center;
            margin-top: 50px;
            color: var(--text-secondary);
            font-size: 0.9rem;
            animation: fadeInUp 0.8s ease-out 0.6s backwards;
        }
        
        footer a {
            color: var(--accent);
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">⚡ PHP Docker Service</div>
            <p class="subtitle">Development Environment</p>
        </header>
        
        <div class="status-grid">
            <!-- PHP Info -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon php">🐘</div>
                    <div class="card-title">PHP</div>
                </div>
                <div class="status-row">
                    <span class="status-label">Version</span>
                    <span class="status-value"><?= phpversion() ?></span>
                </div>
                <div class="status-row">
                    <span class="status-label">Max Execution</span>
                    <span class="status-value"><?= ini_get('max_execution_time') ?>s</span>
                </div>
                <div class="status-row">
                    <span class="status-label">Memory Limit</span>
                    <span class="status-value"><?= ini_get('memory_limit') ?></span>
                </div>
                <div class="status-row">
                    <span class="status-label">Upload Max</span>
                    <span class="status-value"><?= ini_get('upload_max_filesize') ?></span>
                </div>
            </div>
            
            <!-- MySQL Info -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon mysql">🗄️</div>
                    <div class="card-title">MySQL</div>
                </div>
                <?php
                $mysql_host = getenv('MYSQL_HOST') ?: 'mysql';
                $mysql_user = getenv('MYSQL_USER') ?: 'root';
                $mysql_pass = getenv('MYSQL_PASSWORD') ?: 'root';
                $mysql_connected = false;
                $mysql_version = 'N/A';
                
                try {
                    $pdo = new PDO("mysql:host=$mysql_host", $mysql_user, $mysql_pass);
                    $mysql_version = $pdo->query('SELECT VERSION()')->fetchColumn();
                    $mysql_connected = true;
                } catch (Exception $e) {
                    // Connection failed
                }
                ?>
                <div class="status-row">
                    <span class="status-label">Status</span>
                    <span class="status-value <?= $mysql_connected ? '' : 'warning' ?>">
                        <?= $mysql_connected ? '✓ Connected' : '⚠ Disconnected' ?>
                    </span>
                </div>
                <div class="status-row">
                    <span class="status-label">Version</span>
                    <span class="status-value"><?= $mysql_version ?></span>
                </div>
                <div class="status-row">
                    <span class="status-label">Host</span>
                    <span class="status-value"><?= $mysql_host ?></span>
                </div>
                <div class="status-row">
                    <span class="status-label">PDO Driver</span>
                    <span class="status-value"><?= extension_loaded('pdo_mysql') ? '✓ Loaded' : '✗ Missing' ?></span>
                </div>
            </div>
            
            <!-- Apache Info -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon apache">🔺</div>
                    <div class="card-title">Apache</div>
                </div>
                <div class="status-row">
                    <span class="status-label">Software</span>
                    <span class="status-value"><?= $_SERVER['SERVER_SOFTWARE'] ?? 'Apache' ?></span>
                </div>
                <div class="status-row">
                    <span class="status-label">Document Root</span>
                    <span class="status-value">/var/www/html</span>
                </div>
                <div class="status-row">
                    <span class="status-label">Server Port</span>
                    <span class="status-value"><?= $_SERVER['SERVER_PORT'] ?></span>
                </div>
                <div class="status-row">
                    <span class="status-label">Protocol</span>
                    <span class="status-value"><?= $_SERVER['SERVER_PROTOCOL'] ?></span>
                </div>
            </div>
            
            <!-- Server Info -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon server">🖥️</div>
                    <div class="card-title">Server</div>
                </div>
                <div class="status-row">
                    <span class="status-label">Hostname</span>
                    <span class="status-value"><?= gethostname() ?></span>
                </div>
                <div class="status-row">
                    <span class="status-label">OS</span>
                    <span class="status-value"><?= PHP_OS ?></span>
                </div>
                <div class="status-row">
                    <span class="status-label">Timezone</span>
                    <span class="status-value"><?= date_default_timezone_get() ?></span>
                </div>
                <div class="status-row">
                    <span class="status-label">Date</span>
                    <span class="status-value"><?= date('Y-m-d H:i:s') ?></span>
                </div>
            </div>
        </div>
        
        <!-- Extensions -->
        <div class="card" style="margin-bottom: 20px; animation-delay: 0.45s;">
            <div class="card-header">
                <div class="card-title">Loaded Extensions</div>
            </div>
            <div class="extensions-list">
                <?php
                $extensions = get_loaded_extensions();
                sort($extensions);
                foreach ($extensions as $ext): ?>
                    <span class="extension-badge"><?= $ext ?></span>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- Quick Links -->
        <div class="quick-links">
            <h2>🔗 Quick Links</h2>
            <div class="links-grid">
                <a href="/phpinfo.php" class="link-item">
                    <span>📋</span>
                    PHP Info
                </a>
                <a href="http://localhost:8888" target="_blank" class="link-item">
                    <span>🗃️</span>
                    phpMyAdmin
                </a>
                <a href="https://www.php.net/docs.php" target="_blank" class="link-item">
                    <span>📚</span>
                    PHP Docs
                </a>
                <a href="https://hub.docker.com/" target="_blank" class="link-item">
                    <span>🐳</span>
                    Docker Hub
                </a>
            </div>
        </div>
        
        <footer>
            <p>PHP Docker Service &bull; <a href="#">View on GitHub</a></p>
        </footer>
    </div>
</body>
</html>

