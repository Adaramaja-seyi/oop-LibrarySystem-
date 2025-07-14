# Library Management System

A PHP Object-Oriented Programming project implementing a Library Management System.

## Features

- Manage books and magazines with inheritance from LibraryItem
- Member registration and book borrowing
- Tracking of borrowing activities with due dates
- Iterator implementation for easy library item traversal
- Static property to track total items in the library

## OOP Concepts Implemented

1. **Classes and Objects**: Book, Magazine, Member, Library, and Borrowing classes
2. **Inheritance**: Book and Magazine inherit from abstract LibraryItem class
3. **Encapsulation**: Private properties with public getters/setters
4. **Polymorphism**: Borrowable interface implemented by Book and Magazine
5. **Abstraction**: LibraryItem as an abstract base class
6. **Composition**: Borrowing class composed with Book and Member

## Additional PHP Concepts

### Namespaces

Namespaces are used to organize code and prevent naming collisions. In this project:

- `LibrarySystem\Entities` contains all entity classes (Book, Magazine, Member)
- `LibrarySystem\Actions` contains action-related classes (Borrowing, Borrowable)

Namespaces help:
- Keep related code together
- Avoid class name conflicts
- Make autoloading easier
- Improve code organization and readability

### Iterator Interface

The Library class implements the Iterator interface, allowing foreach iteration over all items (books and magazines). This provides:

- A standardized way to traverse collections
- Clean syntax for accessing all items
- Flexibility to change internal storage without affecting client code

The Iterator requires implementing:
- current() - Returns the current element
- key() - Returns the key of the current element
- next() - Moves forward to next element
- rewind() - Rewinds to the first element
- valid() - Checks if current position is valid

### Static Properties

Static properties belong to the class rather than instances. In this project:

- `Library::$totalItems` tracks total items across all Library instances
- Accessed via `Library::getTotalItems()` static method

Key differences from instance properties:
- Shared across all instances
- Accessed via class name (::) not object (->)
- Useful for class-level data and counters