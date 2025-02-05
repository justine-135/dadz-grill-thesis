# Dadz Grill Restaurant Ordering System

### Overview

The Dadz Grill Restaurant Ordering System is a web-based application designed to optimize the ordering process, table monitoring, and kitchen management for Dadz Grill Restaurant. This system aims to streamline restaurant operations by improving efficiency, order accuracy, and customer experience.

Developed as a final research project for Computer Engineering Technology, this system provides a fully functional point-of-sale (POS) solution, allowing restaurant staff to manage tables, track orders, and process transactions seamlessly.


### Technologies Used

#### Frontend

HTML5 – Structured and semantic web content.

CSS3 – Responsive design for a user-friendly interface.

JavaScript – Interactive features for a dynamic experience.

#### Backend

PHP – Server-side scripting for business logic.

MySQL – Relational database for structured data management.


### Installation & Setup

#### Prerequisites

Ensure you have the following installed:

XAMPP (or any local server environment with PHP & MySQL)

A web browser (Google Chrome, Mozilla Firefox, etc.)

#### Steps to Set Up Locally

Clone the Repository

git clone https://github.com/your-username/Dadz-grill-thesis.git

Or manually download and extract the ZIP file.

#### Start the Local Server

Open XAMPP and start Apache and MySQL.

Import the Database

Open phpMyAdmin (http://localhost/phpmyadmin/).

Create a new database (e.g., dadz_grill).

Import the provided .sql file located in the repository.

#### Run the Project

Place the project folder inside the htdocs directory of XAMPP.

Open your browser and navigate to:

http://localhost/[foldername]

Login as Superuser

Username: manager

Password: manager


### Features

#### 🏷️ Table Monitoring System

Real-time table status display with color-coded indicators:

🔴 Red – Occupied

🟢 Green – Unoccupied

🟡 Yellow – Needs assistance

🔵 Blue – Dirty

⚫ Grey – Not connected to the device

🟣 Purple – Connecting to the device

Table timer to track dining duration.

Order tracking with a detailed history of customer orders.

#### Billing & Transactions:

Process and save customer transactions.

Generate billing summaries.

#### Table management:

Add or remove tables dynamically.

#### 🍽️ Menu & Ordering System

Point-of-Sale (POS) food ordering system:

Select and customize food items.

Update quantity.

Display total cost in real-time.

#### Menu management:

Add, update, or delete food items.

#### 👨‍🍳 Kitchen Order Management

Real-time order queue for kitchen staff.

Order processing system:

Mark orders as completed or canceled.

#### 🔐 User Accounts & Security

Account registration and role-based access.

Performance review tracking for staff.

Login history and activity monitoring.


### Why This Project Stands Out 🚀

Efficient Order Processing – Reduces wait times and enhances customer service.

Automated Table Monitoring – Eliminates manual tracking for better efficiency.

User-Friendly POS Interface – Simplifies order and transaction management.

Secure Access Control – Ensures only authorized users can manage critical features.


### Future Enhancements 🛠️

Mobile App Integration – Allow customers to place orders via a mobile app.

Customer Feedback System – Gather and analyze customer reviews.

Data Analytics & Reports – Generate insights into sales, popular items, and staff performance.
