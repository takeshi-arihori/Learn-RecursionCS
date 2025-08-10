# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Repository Overview

This is a Recursion Curriculum learning repository containing programming exercises and implementations across multiple languages: PHP, Java, JavaScript/TypeScript, Go, Python, C++, and C. The repository follows a structured approach organized by learning topics and difficulty levels.

## Project Structure

```
/
├── beginner/               # Basic programming exercises
│   └── php/               # PHP fundamentals and basic concepts
├── intermediate/          # Intermediate level algorithms and concepts
│   └── php/              # PHP intermediate exercises with extensive testing
├── advanced/             # Advanced algorithms and data structures
│   ├── php/             # PHP binary tree implementations
│   └── java/            # Java advanced algorithms
├── oop/                 # Object-oriented programming with Docker
│   └── src/models/      # Person and Wallet classes (PHP)
├── lang-training/       # Language-specific training projects
│   ├── go/             # Go web API server with frontend
│   └── typescript/     # TypeScript exercises
├── database/           # Database-related exercises
│   └── c/             # C++ database implementations
├── video-compressor/   # Video compression and networking
│   └── python/        # Python UDP client-server projects
└── daily/             # Learning logs and daily notes
```

## Development Commands

### PHP Development

#### Beginner Level
```bash
# Run beginner exercises
cd beginner/php
php main.php
```

#### Intermediate Level
```bash
# Run intermediate exercises
cd intermediate/php
php main.php
```

#### OOP with Docker
```bash
# Run tests for OOP exercises
cd oop && ./vendor/bin/phpunit

# Docker environment
cd oop && docker-compose up -d
```

#### Advanced Level
```bash
# Run advanced PHP exercises
cd advanced/php
php main.php
```

### Go Development
```bash
# Run Go web server
cd lang-training/go && go run .

# Server runs on http://localhost:8000
# Endpoints: /api/hello, /api/categories, /api/calculator
```

### Java Development
```bash
# Compile and run Java algorithms
cd advanced/java
javac *.java
java BinaryTree  # or other classes
```

### TypeScript Development
```bash
# TypeScript training exercises
cd lang-training/typescript
npx tsc           # Compile TypeScript
```

### Python Development
```bash
# Video compressor UDP networking
cd video-compressor/python/udp-test

# Terminal 1: Start the server
python3 server.py
# Server creates a named pipe and waits for input

# Terminal 2: Start the client (in separate terminal)
python3 client.py
# Client reads from the named pipe and displays received data
```

### C++ Development
```bash
# Database exercises
cd database/c
g++ -o db db.cpp
./db
```

## Key Architecture Patterns

### PHP Structure
- **Beginner**: Basic PHP concepts and fundamental programming
- **Intermediate**: Advanced algorithms with comprehensive testing
- **OOP**: Object-oriented patterns with Docker containerization
- **Advanced**: Binary tree implementations and complex data structures
- Test-driven development with PHPUnit in relevant sections
- Uses Composer for dependency management in OOP section

### Go API Server (lang-training/go)
- RESTful API design with standard library (`net/http`)
- CORS-enabled for frontend integration
- Structured with separate files: `main.go`, `handlers.go`, `models.go`
- Frontend demo with vanilla JavaScript

### Java Implementation (advanced/java)
- Advanced algorithms and data structures
- Binary trees, linked lists, sliding window algorithms
- Object-oriented design patterns
- Focus on algorithmic problem solving

### Python Networking (video-compressor/python)
- UDP client-server communication
- Named pipe (FIFO) implementations
- Network programming concepts
- Real-time data transmission

### Testing Strategy
- PHP: PHPUnit with comprehensive test suites in `oop/tests/` and `intermediate/php/tests/`
- Java: Standard algorithmic testing patterns
- Go: Standard library testing patterns
- Python: Integration testing for networking components

## Commit Convention

The repository follows a Japanese commit convention:
- `fix`: バグ修正 (Bug fixes)
- `add`: 新規機能追加 (New features)
- `update`: 機能修正 (Feature updates)
- `change`: 仕様変更 (Specification changes)
- `clean`: リファクタリング (Refactoring)
- `remove`: 削除 (Removal)

## Learning Focus Areas

This curriculum emphasizes progressive learning through structured topics:

### Beginner Level
- **Basic Programming Concepts**: Variables, functions, control structures
- **PHP Fundamentals**: Core language features and syntax

### Intermediate Level  
- **Algorithm Implementation**: Sorting, searching, mathematical algorithms
- **Complex Problem Solving**: Multi-step algorithmic challenges
- **Testing Methodology**: Comprehensive unit testing with PHPUnit

### Advanced Level
- **Data Structures**: Binary trees, linked lists, complex algorithms
- **Java Programming**: Advanced object-oriented concepts
- **Algorithm Optimization**: Time and space complexity considerations

### Specialized Topics
- **Object-Oriented Programming**: Class design, inheritance, encapsulation (OOP section)
- **Web Development**: RESTful API design with Go (lang-training)
- **Database Programming**: C++ database implementations
- **Network Programming**: UDP client-server communication (video-compressor)
- **Daily Learning**: Structured learning logs and progress tracking