<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories for assignment
        $categories = BlogCategory::all();

        $blogs = [
            [
                'title' => 'Getting Started with Laravel: A Beginner\'s Guide',
                'description' => 'Learn the fundamentals of Laravel framework and start building modern PHP applications. This comprehensive guide covers installation, routing, controllers, and more.',
                'content' => '<p>Laravel is a free, open-source PHP web framework created by Taylor Otwell and intended for the development of web applications following the model–view–controller (MVC) architectural pattern.</p><p>In this guide, we will explore the basics of Laravel including installation, routing, middleware, controllers, and views. By the end of this tutorial, you will have a solid understanding of how Laravel works and be ready to build your first application.</p><h2>Why Laravel?</h2><p>Laravel offers an elegant syntax and powerful features like Eloquent ORM, Artisan console, and built-in authentication. It simplifies common tasks like routing, sessions, caching, and authentication, making it easier and faster to build web applications.</p>',
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => '10 Essential Design Principles for Modern Websites',
                'description' => 'Discover the key design principles that make websites stand out. From typography to color theory, learn what makes a great user experience.',
                'content' => '<p>Good design is the foundation of any successful website. Whether you\'re building a portfolio, e-commerce site, or blog, these principles will help you create visually appealing and user-friendly designs.</p><h2>1. White Space is Your Friend</h2><p>Don\'t be afraid of empty space. White space helps improve readability and creates a clean, modern look.</p><h2>2. Consistent Typography</h2><p>Use a limited number of fonts and maintain consistency throughout your design for a professional appearance.</p>',
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Mastering JavaScript Async/Await',
                'description' => 'Deep dive into asynchronous JavaScript programming with async/await syntax. Write cleaner, more maintainable code.',
                'content' => '<p>Asynchronous programming in JavaScript has evolved significantly. From callbacks to promises, and now to async/await, writing async code has become more intuitive and readable.</p><h2>Understanding Promises</h2><p>Before diving into async/await, it\'s important to understand promises. A promise represents an operation that hasn\'t completed yet but is expected in the future.</p><h2>The Async/Await Syntax</h2><p>Async/await is syntactic sugar over promises. It makes asynchronous code look and behave like synchronous code, making it easier to read and debug.</p>',
                'is_published' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Building Scalable APIs with REST Best Practices',
                'description' => 'Learn how to design and implement RESTful APIs that are scalable, maintainable, and developer-friendly.',
                'content' => '<p>RESTful APIs have become the standard for web service communication. Following REST best practices ensures your API is intuitive, scalable, and easy to maintain.</p><h2>Use Proper HTTP Methods</h2><p>GET for retrieving data, POST for creating resources, PUT/PATCH for updating, and DELETE for removing resources.</p><h2>Version Your API</h2><p>Always version your API from the start. This allows you to make breaking changes without affecting existing clients.</p>',
                'is_published' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'The Future of Web Development: Trends to Watch',
                'description' => 'Explore emerging technologies and trends shaping the future of web development in 2024 and beyond.',
                'content' => '<p>The web development landscape is constantly evolving. Stay ahead of the curve by understanding these emerging trends.</p><h2>AI-Powered Development</h2><p>Artificial intelligence is transforming how we build websites, from automated code generation to intelligent testing.</p><h2>WebAssembly</h2><p>WebAssembly enables high-performance applications in the browser, opening new possibilities for web development.</p>',
                'is_published' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'CSS Grid vs Flexbox: When to Use Which',
                'description' => 'Understand the differences between CSS Grid and Flexbox and learn when to use each layout system effectively.',
                'content' => '<p>CSS Grid and Flexbox are both powerful layout systems in CSS. Understanding when to use each one is key to creating responsive, flexible designs.</p><h2>CSS Grid</h2><p>Grid is a two-dimensional layout system, handling both columns and rows simultaneously. It\'s perfect for overall page layouts.</p><h2>Flexbox</h2><p>Flexbox is a one-dimensional layout method, great for aligning items in a single row or column. Use it for component-level layouts.</p>',
                'is_published' => true,
                'sort_order' => 6,
            ],
            [
                'title' => 'Database Optimization Techniques for High Traffic',
                'description' => 'Learn proven strategies to optimize your database for high-traffic applications and improve performance.',
                'content' => '<p>As your application grows, database performance becomes critical. These optimization techniques will help you handle high traffic efficiently.</p><h2>Indexing Strategies</h2><p>Proper indexing can dramatically improve query performance. Identify frequently queried columns and add appropriate indexes.</p><h2>Query Optimization</h2><p>Avoid N+1 queries, use eager loading, and select only the columns you need to reduce database load.</p>',
                'is_published' => true,
                'sort_order' => 7,
            ],
            [
                'title' => 'Introduction to Docker for Developers',
                'description' => 'Get started with Docker containerization and streamline your development workflow with consistent environments.',
                'content' => '<p>Docker has revolutionized how developers build, ship, and run applications. Learn the basics of containerization and how it can improve your workflow.</p><h2>What is Docker?</h2><p>Docker is a platform for developing, shipping, and running applications in containers. Containers package code and dependencies together for consistent deployment.</p><h2>Getting Started</h2><p>Start with a simple Dockerfile, build an image, and run your first container. Docker Compose helps manage multi-container applications.</p>',
                'is_published' => true,
                'sort_order' => 8,
            ],
            [
                'title' => 'Security Best Practices for Web Applications',
                'description' => 'Protect your web applications from common vulnerabilities with these essential security practices and techniques.',
                'content' => '<p>Security should be a top priority for every web developer. Implement these best practices to protect your applications and user data.</p><h2>Input Validation</h2><p>Always validate and sanitize user input to prevent SQL injection, XSS, and other attacks.</p><h2>Authentication & Authorization</h2><p>Implement proper authentication mechanisms and ensure users can only access resources they\'re authorized to view.</p>',
                'is_published' => true,
                'sort_order' => 9,
            ],
            [
                'title' => 'Performance Monitoring and Debugging in Production',
                'description' => 'Master the art of monitoring and debugging production applications to ensure optimal performance and reliability.',
                'content' => '<p>Monitoring and debugging in production requires a different approach than development. Learn the tools and techniques for maintaining healthy applications.</p><h2>Logging Strategies</h2><p>Implement structured logging with appropriate log levels. Use centralized logging solutions for easier analysis.</p><h2>Performance Monitoring</h2><p>Set up monitoring for key metrics like response time, error rates, and resource usage. Use APM tools for deep insights.</p>',
                'is_published' => true,
                'sort_order' => 10,
            ],
            [
                'title' => 'Building Progressive Web Apps (PWAs)',
                'description' => 'Create app-like experiences on the web with Progressive Web Apps. Learn about service workers, offline functionality, and more.',
                'content' => '<p>Progressive Web Apps combine the best of web and mobile apps. They\'re reliable, fast, and engaging, working offline and on low-quality networks.</p><h2>Service Workers</h2><p>Service workers are the backbone of PWAs, enabling offline functionality, push notifications, and background sync.</p><h2>App Manifest</h2><p>The web app manifest provides information about your app, enabling installation on home screens and full-screen experiences.</p>',
                'is_published' => true,
                'sort_order' => 11,
            ],
            [
                'title' => 'Git Workflow Strategies for Teams',
                'description' => 'Discover effective Git workflows for team collaboration, from feature branches to continuous deployment.',
                'content' => '<p>A well-defined Git workflow is essential for team productivity. Explore different strategies and find the one that works best for your team.</p><h2>Feature Branch Workflow</h2><p>Create a new branch for each feature or bug fix. This keeps the main branch stable and makes code review easier.</p><h2>Git Flow vs Trunk-Based</h2><p>Git Flow provides structure with develop and feature branches, while trunk-based development emphasizes frequent integration to the main branch.</p>',
                'is_published' => true,
                'sort_order' => 12,
            ],
        ];

        foreach ($blogs as $index => $blogData) {
            Blog::firstOrCreate(
                ['title' => $blogData['title']],
                [
                    'slug' => Str::slug($blogData['title']) . '-' . time() . '-' . $index,
                    'category_id' => $categories->random()->id,
                    'cover_image' => null,
                    'description' => $blogData['description'],
                    'content' => $blogData['content'],
                    'seo_title' => $blogData['title'],
                    'seo_description' => Str::limit($blogData['description'], 160),
                    'is_published' => $blogData['is_published'],
                    'sort_order' => $blogData['sort_order'],
                    'created_at' => now()->subDays(rand(0, 60)),
                    'updated_at' => now(),
                ]
            );
        }
    }
}