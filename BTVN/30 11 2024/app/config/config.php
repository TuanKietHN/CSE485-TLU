<?php
// URL Configuration
define('BASE_URL', 'CSE485-TLU/BTVN/30 11 2024');

// Path Configuration
define('ROOT_DIR', dirname(dirname(__DIR__)));
define('APP_DIR', ROOT_DIR . '/app');
define('PUBLIC_DIR', ROOT_DIR . '/public');
define('VIEW_DIR', APP_DIR . '/views');
define('CONTROLLER_DIR', APP_DIR . '/controllers');
define('MODEL_DIR', APP_DIR . '/models');
define('UPLOAD_DIR', PUBLIC_DIR . '/uploads');

// Debug Mode
define('DEBUG_MODE', true);

// Timezone & Encoding
date_default_timezone_set('Asia/Ho_Chi_Minh');
mb_internal_encoding('UTF-8');