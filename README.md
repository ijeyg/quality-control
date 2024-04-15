# Project Name: Quality Control

## Introduction
This project is a Laravel application built using the HMVC (Hierarchical Model-View-Controller) architectural pattern with modularization. It leverages various design patterns such as Repository, Builder, Data Mapper, Strategy, and Factory Method to achieve a scalable and maintainable codebase.

## Project Description
This source code is developed for quality control of products using various devices under different conditions. It aims to ensure the quality and reliability of manufactured goods by employing a systematic approach to testing and inspection across diverse scenarios.

## Features
- **HMVC Structure**: Organizes the application into modules, each with its own MVC triad, allowing for better code organization and separation of concerns.
- **Repository Pattern**: Abstracts data access logic, providing a clean and consistent interface for interacting with data from different sources.
- **Builder Pattern**: Used for constructing complex objects step by step, allowing for flexible object creation.
- **Data Mapper**: Separates the in-memory representation of data from its persistent storage, providing a layer of abstraction between the domain objects and the database.
- **Strategy Pattern**: Enables interchangeable algorithms or behaviors, promoting flexibility and extensibility.
- **Factory Method**: Defines an interface for creating objects, but allows subclasses to alter the type of objects that will be created.

## Installation
1. Clone the repository: `git clone https://github.com/ijeyg/quality-control.git`
2. Navigate to the project directory: `cd quality-control`
3. Install dependencies: `composer install`
4. Set up your environment variables: configure `.env` accordingly.
5. Generate application key: `php artisan key:generate`
6. Run migrations: `php artisan migrate`
7. (Optional) Seed the database: `php artisan db:seed`

## Usage
1. Start the development server: `php artisan serve`
2. Access the application in your web browser at `http://localhost:8000`

## Contributing
Contributions are welcome! If you have any ideas, improvements, or bug fixes, feel free to open an issue or create a pull request.

## License
This project is licensed under the [MIT License](LICENSE).
