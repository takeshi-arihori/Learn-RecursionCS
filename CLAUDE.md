# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Repository Overview

This is a Recursion Curriculum learning repository containing programming exercises and implementations across multiple languages: PHP, Java, JavaScript/TypeScript, Go, Python, C++, and SQL. The repository follows a structured approach with beginner, intermediate, and advanced level exercises organized by language.

## Project Structure

```
/
├── php/                    # PHP implementations with Docker environment
├── go/                     # Go web API server with frontend demo
├── js/                     # JavaScript/TypeScript projects
│   ├── my-react-app/       # React application with Vite
│   └── db-relation/        # TypeScript database relations
├── java/                   # Java algorithms and data structures
├── python/                 # Python projects including UDP networking
├── c/                      # C++ implementations
└── sql/                    # SQL exercises
```

## Development Commands

### PHP Development
```bash
# Run tests
cd php/src && ./vendor/bin/phpunit

# Docker environment
cd php && docker-compose up -d

# Access MySQL container
docker-compose exec mysql /bin/bash
mysql -u root -p  # password: password
```

### Go Development
```bash
# Run Go server
cd go && go run .

# Server runs on http://localhost:8000
# Endpoints: /api/hello, /api/categories, /api/calculator
```

### JavaScript/React Development
```bash
# React app
cd js/my-react-app
npm run dev        # Development server
npm run build      # Production build
npm run lint       # ESLint

# TypeScript compilation
cd js/db-relation
npx tsc           # Compile TypeScript
```

### Python Development
```bash
# Named pipe (FIFO) server/client example
cd python/udp-test

# Terminal 1: Start the server
python3 server.py
# Server creates a named pipe and waits for input
# Type messages to send to clients, type 'exit' to quit

# Terminal 2: Start the client (in separate terminal)
python3 client.py
# Client reads from the named pipe and displays received data
```

## Key Architecture Patterns

### PHP Structure
- Follows object-oriented patterns with proper class separation
- Test-driven development with PHPUnit
- Uses Composer for dependency management
- Docker containerization with Nginx, PHP-FPM, and MySQL

### Go API Server
- RESTful API design with standard library (`net/http`)
- CORS-enabled for frontend integration
- Structured with separate files: `main.go`, `handlers.go`, `models.go`
- Frontend demo with vanilla JavaScript

### React Application
- Vite build tool with hot module replacement
- Component-based architecture
- Styled Components for CSS-in-JS
- useState hooks for state management

### Testing Strategy
- PHP: PHPUnit with test suites in `tests/` directories
- JavaScript: ESLint for code quality
- Go: Standard library testing patterns (implied)

## Commit Convention

The repository follows a Japanese commit convention:
- `fix`: バグ修正 (Bug fixes)
- `add`: 新規機能追加 (New features)
- `update`: 機能修正 (Feature updates)
- `change`: 仕様変更 (Specification changes)
- `clean`: リファクタリング (Refactoring)
- `remove`: 削除 (Removal)

## Learning Focus Areas

This curriculum emphasizes:
- **Algorithm Implementation**: Binary trees, linked lists, sorting algorithms
- **Web Development**: Full-stack applications with API design
- **Database Relations**: Understanding data modeling
- **Object-Oriented Programming**: Class design and inheritance
- **Functional Programming**: Recursion and function composition
- **Network Programming**: UDP client-server communication