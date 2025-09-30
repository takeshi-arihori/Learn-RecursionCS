# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Repository Overview

This is a Recursion Curriculum learning repository containing programming exercises and implementations across multiple languages: PHP, Java, JavaScript/TypeScript, Go, Python, C++, and C. The repository follows a structured approach organized by learning topics and difficulty levels.

## Project Structure

```
/
├── php/                   # PHP projects (unified)
│   ├── beginner/         # PHP fundamentals and basic concepts
│   ├── intermediate/     # PHP intermediate exercises with extensive testing
│   ├── advanced/         # PHP binary tree implementations
│   ├── oop/              # Object-oriented programming with Docker
│   ├── dynamic-web-server/ # Web server project with Cars/Engine
│   └── docker-php/       # PHP Docker integration environment
├── beginner/             # Basic programming exercises (multi-language)
├── intermediate/         # Intermediate level algorithms (multi-language)
├── advanced/             # Advanced algorithms and data structures
│   └── java/            # Java advanced algorithms
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
cd php/beginner
php main.php

# Run tests (TDD approach)
php tests/ConvertToCenturyTest.php
```

#### Intermediate Level
```bash
# Run intermediate exercises
cd php/intermediate
php main.php

# Run PHPUnit tests
./vendor/bin/phpunit tests/
```

#### OOP with Docker
```bash
# Run tests for OOP exercises
cd php/oop && ./vendor/bin/phpunit

# Docker environment
cd php/oop && docker-compose up -d
```

#### Advanced Level
```bash
# Run advanced PHP exercises
cd php/advanced
php main.php

# Run advanced tests
./vendor/bin/phpunit tests/
```

#### Dynamic Web Server
```bash
# Run web server project
cd php/dynamic-web-server
php index.php

# Run Pest tests
./vendor/bin/pest
```

### PHP Quality Assurance & Testing

#### PHPUnit Testing Commands
```bash
# Run all tests
./vendor/bin/phpunit

# Run specific test directory
./vendor/bin/phpunit tests/Audible/

# Run specific test file
./vendor/bin/phpunit tests/Audible/PersonTest.php

# Run tests with coverage (if configured)
./vendor/bin/phpunit --coverage-html coverage/

# Run tests with verbose output
./vendor/bin/phpunit --verbose

# Run only failing tests
./vendor/bin/phpunit --stop-on-failure
```

#### PHPStan Static Analysis Commands
```bash
# Basic analysis (recommended level)
./vendor/bin/phpstan analyse src/ tests/ --level=5

# Maximum strictness analysis
./vendor/bin/phpstan analyse src/ tests/ --level=max

# Analyze specific directory
./vendor/bin/phpstan analyse src/Models/Audible/ --level=max

# Generate baseline (ignore current errors)
./vendor/bin/phpstan analyse --generate-baseline

# Clear result cache
./vendor/bin/phpstan clear-result-cache

# Create alias for convenience (add to ~/.zshrc)
alias phpstan="/path/to/project/vendor/bin/phpstan"
```

#### TDD Development Workflow
```bash
# 1. Write failing test (Red phase)
./vendor/bin/phpunit tests/NewFeatureTest.php
# Expected: FAILURES/ERRORS

# 2. Implement minimum code to pass (Green phase)
# Edit source code...
./vendor/bin/phpunit tests/NewFeatureTest.php
# Expected: OK

# 3. Refactor while keeping tests green
./vendor/bin/phpunit  # Run all tests
./vendor/bin/phpstan analyse src/ --level=max  # Check static analysis

# 4. Commit when all quality checks pass
git add . && git commit -m "feat: ✨ implement new feature with TDD"
```

#### Quality Assurance Checklist
Before committing PHP code, ensure:
1. ✅ All PHPUnit tests pass
2. ✅ PHPStan analysis passes at level 5+ 
3. ✅ Code follows PSR-12 coding standards
4. ✅ DocBlocks are comprehensive and accurate
5. ✅ Interface contracts are properly implemented
6. ✅ No unused properties or methods (PHPStan warnings)

#### Common PHPStan Error Solutions
```bash
# Property never read, only written
# Solution: Add getter method or implement interface that uses the property

# Method has no return type
# Solution: Add proper return type hint: public function getName(): string

# Call to undefined method
# Solution: Check interface implementation or add method

# Class not found
# Solution: Check namespace and autoloading (composer dump-autoload)
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
All PHP projects are organized under the `php/` directory:
- **php/beginner/**: Basic PHP concepts and fundamental programming
- **php/intermediate/**: Advanced algorithms with comprehensive PHPUnit testing
- **php/advanced/**: Binary tree implementations and complex data structures
- **php/oop/**: Object-oriented patterns with Docker containerization
- **php/dynamic-web-server/**: Web server project with Pest testing, logging, and OOP design
- **php/docker-php/**: PHP Docker integration environment (Nginx, MySQL, PHP-FPM)
- Test-driven development with PHPUnit/Pest across all projects
- Composer for dependency management, PHPStan for static analysis

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
- **PHP**: PHPUnit/Pest with comprehensive test suites in `php/oop/tests/`, `php/intermediate/tests/`, `php/dynamic-web-server/tests/`
  - TDD (Red-Green-Refactor) methodology
  - PHPStan static analysis for type safety (Level 9 recommended)
  - Interface segregation testing (PersonLensesTest, TruckPhysicsTest)
  - Given-When-Then test structure pattern
  - Pest framework for dynamic-web-server project
- **Java**: Standard algorithmic testing patterns
- **Go**: Standard library testing patterns
- **Python**: Integration testing for networking components

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

## Development Rules & Tools

### Test-Driven Development (TDD)
This curriculum follows TDD methodology:
1. **Red**: Write a failing test
2. **Green**: Write minimal code to pass the test
3. **Refactor**: Improve code quality

### Required Tools
- **PlantUML**: UML diagram creation (`brew install plantuml`)
- **dbdiagram.io**: Database design and ER diagrams
- **PHPUnit**: PHP testing framework (`composer require --dev phpunit/phpunit`)
- **PHPStan**: Static analysis tool (`composer require --dev phpstan/phpstan`)
- **Docker**: Unified development environment
- **Composer**: PHP dependency management

### Directory Standards
```
php/{project}/
├── src/          # Implementation files
├── tests/        # Test files (TDD)
├── docs/         # Documentation
├── composer.json # Dependencies
├── phpstan.neon  # Static analysis config
└── README.md     # Project documentation
```

### Coding Standards
- **PSR-4**: Autoloading compliance
- **PSR-12**: Coding style compliance
- **Given-When-Then**: Test structure pattern
- **DocBlock**: Comprehensive documentation
- **Type Hints**: Strict typing with `declare(strict_types=1)`
- **Interface Segregation**: Separate test files for different interface implementations
- **TDD**: Test-first development approach (Red-Green-Refactor)

## Claude Code Integration Settings

### Hook Configuration
This project has Claude Code hooks configured in `.claude/hooks.json` for:
- **UserPromptSubmit**: Automatically loads commit guidelines and branch strategy
- **PreToolUse**: Shows warnings before Git operations to enforce proper workflow

### Important Workflow Rules
**⚠️ CRITICAL: Always create feature branches before making changes**

#### Correct Git Workflow:
```bash
# 1. Create feature branch FIRST (hooks will remind you)
git checkout -b feature/your-feature-name

# 2. Make changes and commit
git add .
git commit -m "type: 🔥 description"

# 3. Push branch
git push origin feature/your-feature-name

# 4. Create pull request
gh pr create --title "Title" --body "Description"
```

#### Hook Warning Messages:
When using Git commands (`commit`, `checkout`, `branch`, `merge`, `rebase`, `push`), Claude Code will show:
- Current branch information
- Reminder to check commit guidelines (.github/COMMIT_GUIDELINES.md)
- Reminder to check branch strategy (.github/BRANCH_STRATEGY.md)
- TDD methodology reminder

### Agents Configuration
Available specialized agents in `.claude/agents/`:
- **code-reviewer.md**: Post-coding quality review
- **debugger.md**: Error troubleshooting and bug fixing  
- **test-runner.md**: Test execution and TDD workflows

### Project Documentation
Reference files in `.github/`:
- **COMMIT_GUIDELINES.md**: Detailed commit message rules
- **BRANCH_STRATEGY.md**: Git Flow-based branching strategy
- **CONTRIBUTING.md**: Comprehensive contribution guide
- **pull_request_template.md**: Standard PR template

## Workspace Documentation Standards

### README Requirements for Each Workspace
**CRITICAL**: Every workspace (functional directory/module) MUST have a dedicated README.md file with clear execution procedures.

#### Required README Sections:
1. **概要 (Overview)**: Module purpose and functionality description
2. **実装要件 (Implementation Requirements)**: Technical specifications and constraints
3. **実行方法 (Execution Instructions)**: Step-by-step commands for:
   - Test execution (`./vendor/bin/phpunit tests/ModuleName/`)
   - Static analysis (`./vendor/bin/phpstan analyse -c src/Models/ModuleName/phpstan.neon`)
   - Code quality checks (`composer quality`)
4. **ディレクトリ構成 (Directory Structure)**: File organization and purpose
5. **使用例 (Usage Examples)**: Code examples demonstrating functionality

#### PHPStan Configuration Strategy:
Each workspace SHOULD have its own `phpstan.neon` configuration file to:
- **ALWAYS use level 9** for maximum strictness and code quality
- Define module-specific ignore patterns  
- Avoid cross-module error contamination
- Enable precise quality control

#### Example Workspace Structure:
```
src/Models/ModuleName/
├── Interface.php
├── Implementation.php  
├── phpstan.neon          # Module-specific PHPStan config (level 9)
├── README.md             # REQUIRED: Complete execution guide
└── docs/
    └── diagram.puml

tests/ModuleName/
├── InterfaceTest.php
├── ImplementationTest.php
└── IntegrationTest.php
```

#### Enforcement:
- Claude Code MUST create README.md with execution procedures for every new workspace
- Existing workspaces without README.md should be flagged for documentation updates
- All README files must include working command examples that can be copy-pasted
- PHPStan analysis MUST always use level 9 for highest code quality standards
