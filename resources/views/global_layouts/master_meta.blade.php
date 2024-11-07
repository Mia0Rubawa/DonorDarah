<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title') | {{ env('APP_NAME') }}</title>

<!-- Meta Tags for SEO -->
<meta name="description"
    content="A concise, compelling description of your page (150-160 characters). It should include primary keywords and attract clicks.">
<meta name="keywords" content="primary keyword, secondary keyword, relevant terms related to your content">
<meta name="author" content="Your Name or Business Name">
<meta name="robots" content="index, follow"> <!-- Allows search engines to index and follow links on the page -->
<meta name="googlebot" content="index, follow"> <!-- Specific instructions for Googlebot -->

<!-- Open Graph Meta Tags (for social media sharing) -->
<meta property="og:title" content="Title of Your Page">
<meta property="og:description" content="A compelling description for social media previews.">
<meta property="og:image" content="https://yourwebsite.com/path/to-image.jpg">
<meta property="og:url" content="https://yourwebsite.com/your-page-url">
<meta property="og:type" content="website"> <!-- Use "article" for blog posts, "product" for product pages, etc. -->

<!-- Twitter Card Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Title of Your Page">
<meta name="twitter:description" content="A short description for Twitter previews.">
<meta name="twitter:image" content="https://yourwebsite.com/path/to-image.jpg">

<!-- Favicon -->
<link rel="icon" href="/path/to/favicon.ico" type="image/x-icon">

<!-- Canonical Link (for duplicate content) -->
<link rel="canonical" href="https://yourwebsite.com/your-page-url">
