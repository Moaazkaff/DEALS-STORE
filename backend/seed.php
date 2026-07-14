<?php
// Bring in the database connection
require_once __DIR__ . '/config/db.php';

$db = new Database();
$conn = $db->connect();

if (!$conn) {
    die("Database connection failed.");
}

// Array of fake offers to insert
$offers = [
    [
        'title' => 'Wireless Noise-Canceling Headphones',
        'description' => 'Premium over-ear headphones with 30-hour battery life.',
        'category' => 'Electronics',
        'old_price' => 299.99,
        'discount_percentage' => 20.00, // 20% off
        'image_url' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e',
        'expiry_date' => '2026-12-31'
    ],
    [
        'title' => 'Men\'s Running Shoes',
        'description' => 'Lightweight and breathable sneakers for daily runs.',
        'category' => 'Fashion',
        'old_price' => 120.00,
        'discount_percentage' => 50.00, // 50% off!
        'image_url' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff',
        'expiry_date' => '2026-10-15'
    ],
    [
        'title' => 'Smart Home Coffee Maker',
        'description' => 'Brew your morning coffee using your smartphone.',
        'category' => 'Home Appliances',
        'old_price' => 150.00,
        'discount_percentage' => 15.00, // 15% off
        'image_url' => 'https://images.unsplash.com/photo-1517502884422-41eaead166d4',
        'expiry_date' => '2026-11-20'
    ],
    [
        'title' => 'Apple MacBook Air M3',
        'description' => '13-inch laptop with Apple M3 chip and 16GB RAM.',
        'category' => 'Electronics',
        'old_price' => 1499.99,
        'discount_percentage' => 12.00,
        'image_url' => 'https://images.unsplash.com/photo-1517336714739-489689fd1ca8',
        'expiry_date' => '2026-12-31'
    ],
    [
        'title' => 'Samsung Galaxy S25',
        'description' => 'Latest Samsung flagship smartphone with AI features.',
        'category' => 'Electronics',
        'old_price' => 1099.99,
        'discount_percentage' => 18.00,
        'image_url' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9',
        'expiry_date' => '2026-12-15'
    ],
    [
        'title' => 'Gaming Mechanical Keyboard',
        'description' => 'RGB mechanical keyboard with blue switches.',
        'category' => 'Gaming',
        'old_price' => 129.99,
        'discount_percentage' => 35.00,
        'image_url' => 'https://images.unsplash.com/photo-1511467687858-23d96c32e4ae',
        'expiry_date' => '2026-11-20'
    ],
    [
        'title' => 'Gaming Mouse',
        'description' => 'Ergonomic gaming mouse with adjustable DPI.',
        'category' => 'Gaming',
        'old_price' => 79.99,
        'discount_percentage' => 25.00,
        'image_url' => 'https://images.unsplash.com/photo-1527814050087-3793815479db',
        'expiry_date' => '2026-10-30'
    ],
    [
        'title' => '4K Smart TV 55"',
        'description' => 'Ultra HD Smart TV with HDR support.',
        'category' => 'Electronics',
        'old_price' => 899.99,
        'discount_percentage' => 22.00,
        'image_url' => 'https://images.unsplash.com/photo-1593784991095-a205069470b6',
        'expiry_date' => '2026-12-10'
    ],
    [
        'title' => 'Office Chair',
        'description' => 'Ergonomic office chair with lumbar support.',
        'category' => 'Furniture',
        'old_price' => 249.99,
        'discount_percentage' => 30.00,
        'image_url' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85',
        'expiry_date' => '2026-09-30'
    ],
    [
        'title' => 'Fitness Smart Watch',
        'description' => 'Track heart rate, sleep, and workouts.',
        'category' => 'Wearables',
        'old_price' => 299.99,
        'discount_percentage' => 28.00,
        'image_url' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30',
        'expiry_date' => '2026-11-18'
    ],
    [
        'title' => 'Bluetooth Speaker',
        'description' => 'Portable waterproof Bluetooth speaker.',
        'category' => 'Audio',
        'old_price' => 99.99,
        'discount_percentage' => 40.00,
        'image_url' => 'https://images.unsplash.com/photo-1507878866276-a947ef722fee',
        'expiry_date' => '2026-12-01'
    ],
    [
        'title' => 'DSLR Camera',
        'description' => 'Professional camera with 24MP sensor.',
        'category' => 'Photography',
        'old_price' => 1299.99,
        'discount_percentage' => 17.00,
        'image_url' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32',
        'expiry_date' => '2026-12-20'
    ],
    [
        'title' => 'Backpack',
        'description' => 'Water-resistant backpack for travel and work.',
        'category' => 'Fashion',
        'old_price' => 89.99,
        'discount_percentage' => 32.00,
        'image_url' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee',
        'expiry_date' => '2026-10-31'
    ],
    [
        'title' => 'Air Fryer',
        'description' => 'Healthy cooking with little to no oil.',
        'category' => 'Home Appliances',
        'old_price' => 179.99,
        'discount_percentage' => 20.00,
        'image_url' => 'https://images.unsplash.com/photo-1585515656973-1c39d5b36f33',
        'expiry_date' => '2026-11-25'
    ],
    [
        'title' => 'Mountain Bike',
        'description' => '21-speed mountain bike with aluminum frame.',
        'category' => 'Sports',
        'old_price' => 699.99,
        'discount_percentage' => 15.00,
        'image_url' => 'https://images.unsplash.com/photo-1507035895480-2b3156c31fc8',
        'expiry_date' => '2026-12-31'
    ]
];

// SQL Query (Notice we skip final_price because your database calculates it automatically!)
$query = "INSERT INTO offers (title, description, category, old_price, discount_percentage, image_url, expiry_date) 
          VALUES (:title, :description, :category, :old_price, :discount_percentage, :image_url, :expiry_date)";

$stmt = $conn->prepare($query);

$count = 0;
foreach ($offers as $offer) {
    try {
        $stmt->execute($offer);
        $count++;
    } catch (PDOException $e) {
        echo "Error inserting " . $offer['title'] . ": " . $e->getMessage() . "<br>";
    }
}

echo "Successfully inserted $count fake offers into the database!";
?>