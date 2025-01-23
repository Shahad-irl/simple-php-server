# PHP Simple Server Project

This repository demonstrates a lightweight PHP server implementation. It includes core functionalities for handling HTTP requests, generating responses, and managing autoloading using class and namespace maps.

## Description

The **PHP Simple Server Project** serves as an educational and foundational tool for PHP developers. It offers insights into building a server-side application without relying on heavy frameworks. The project is designed to teach the principles of:

- HTTP request and response handling.
- PHP autoloading mechanisms with namespaces and class maps.
- Building scalable and minimalistic server-side applications.

## Features

- **Custom Autoloader**:
  - `autoload_classmap.php`: Maps classes to file paths.
  - `autoload_namespace.php`: Maps namespaces to directories.
  - `ClassLoader.php`: Registers the autoloader for seamless class and namespace loading.
- **Request Handling**:
  - `Request.php`: Parses HTTP methods, URIs, headers, and parameters.
- **Response Management**:
  - `Response.php`: Manages HTTP responses, including headers, body content, and status codes.
- **Error Handling**:
  - `Exception.php`: Custom exception handling for the PHPServer namespace.
- **Server Logic**:
  - `Server.php`: Handles incoming HTTP requests and dispatches responses.

## Purpose

In real-world scenarios, this project can serve as a starting point for:

- Learning the fundamentals of server-side development in PHP.
- Prototyping APIs or microservices.
- Customizing a lightweight server framework for specific use cases.

## Why It's Helpful

- **Educational Value**: Simplifies the complexity of frameworks by focusing on core concepts.
- **Flexibility**: Allows developers to customize and extend the server to meet unique requirements.
- **Efficiency**: Lightweight design for small-scale projects and APIs.
- **Framework Independence**: Provides a deeper understanding of PHP's capabilities without external dependencies.

## Challenges Addressed

1. **Autoloading Complexity**:

   - Simplified class and namespace autoloading for better organization.

2. **Error Logging**:

   - Enhanced error detection for missing files or invalid inputs.

3. **Scalability**:

   - Modular design for easy extension and integration.

4. **Compatibility**:

   - Fully compatible with PHP 7.4 and later (including PHP 8.x).

## Installation

1. Clone this repository:

   ```bash
   git clone https://github.com/your-username/php-simple-server.git

2. Navigate to the project directory:
 
   ```bash
   git clone https://github.com/your-username/php-simple-server.git

   
