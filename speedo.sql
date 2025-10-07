
-- phpMyAdmin SQL Dump
-- Database: `yocab`

CREATE DATABASE IF NOT EXISTS speedo;
USE speedo;

-- Table structure for table `customer`
CREATE TABLE IF NOT EXISTS customer (
    userid INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    address TEXT,
    contact_number VARCHAR(15),
    bookingid INT,
    image VARCHAR(255),
    payment_done BOOLEAN DEFAULT 0
);

-- Table structure for table `driver`
CREATE TABLE IF NOT EXISTS driver (
    driverid INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    address TEXT,
    contact_number VARCHAR(15),
    bookingid INT,
    image VARCHAR(255),
    balance FLOAT DEFAULT 0.0
);

-- Table structure for table `trip`
CREATE TABLE IF NOT EXISTS trip (
    tripid INT AUTO_INCREMENT PRIMARY KEY,
    bookingid INT,
    userid INT,
    driverid INT,
    car_number VARCHAR(50),
    trip_time DATETIME,
    destination TEXT,
    fare FLOAT
);

-- Table structure for table `car`
CREATE TABLE IF NOT EXISTS car (
    car_number VARCHAR(50) PRIMARY KEY,
    type VARCHAR(50),
    bookingid INT
);

-- Table structure for table `payment_card`
CREATE TABLE IF NOT EXISTS payment_card (
    card_number VARCHAR(20) PRIMARY KEY,
    paymentid VARCHAR(10),
    card_holder_name VARCHAR(100),
    balance FLOAT
);

-- Sample data for demo purposes
INSERT INTO customer (name, email, address, contact_number, bookingid, image, payment_done) VALUES
('John Doe', 'john@example.com', '123 Street, City', '1234567890', 1, 'john.jpg', 0);

INSERT INTO driver (name, email, address, contact_number, bookingid, image, balance) VALUES
('Jane Smith', 'jane@example.com', '456 Avenue, City', '0987654321', 1, 'jane.jpg', 100.0);

INSERT INTO trip (bookingid, userid, driverid, car_number, trip_time, destination, fare) VALUES
(1, 1, 1, 'CAR123', NOW(), 'Downtown', 50.0);

INSERT INTO car (car_number, type, bookingid) VALUES
('CAR123', 'Sedan', NULL);

INSERT INTO payment_card (card_number, paymentid, card_holder_name, balance) VALUES
('1111222233334444', '123', 'John Doe', 200.0);
