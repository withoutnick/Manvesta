<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Dashboard posts per page
    |--------------------------------------------------------------------------
    |
    | This value determines how many posts are visible in the user's dashboard 
    | on a single page.
    |
    */
    'dashboard_posts_per_page' => env('DASHBOARD_POSTS_PER_PAGE', 20),

    /*
    |--------------------------------------------------------------------------
    | Frontend posts per page
    |--------------------------------------------------------------------------
    |
    | This value determines how many posts are visible in frontend 
    | on a single page.
    |
    */
    'frontend_posts_per_page' => env('FRONTEND_POSTS_PER_PAGE', 20),
   
    /*
    |--------------------------------------------------------------------------
    | API posts per page
    |--------------------------------------------------------------------------
    |
    | This value determines how many posts are visible in API 
    | on a single page.
    |
    */
    'api_posts_per_page' => env('API_POSTS_PER_PAGE', 50),



    /*
    |--------------------------------------------------------------------------
    | Post Cache TTL
    |--------------------------------------------------------------------------
    |
    | How often should post cache be cleared for the front-end
    |
    */
    'ttl' => env('POST_CACHE_TTL', 300),

    /*
    |--------------------------------------------------------------------------
    | Post Cache API TTL
    |--------------------------------------------------------------------------
    |
    | How often should post cache be cleared for the API
    |
    */
    'api_ttl' => env('API_CACHE_TTL', 500),


];