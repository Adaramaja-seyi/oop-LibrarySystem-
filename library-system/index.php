<?php
require_once __DIR__ . '/src/Entities/LibraryItem.php';
require_once __DIR__ . '/src/Entities/Borrowable.php';
require_once __DIR__ . '/src/Entities/Book.php';
require_once __DIR__ . '/src/Entities/Magazine.php';
require_once __DIR__ . '/src/Entities/Member.php';
require_once __DIR__ . '/src/Actions/Borrowing.php';
require_once __DIR__ . '/src/Library.php';

use LibrarySystem\Entities\Book;
use LibrarySystem\Entities\Magazine;
use LibrarySystem\Entities\Member;
use LibrarySystem\Library;

// Create library instance
$library = new Library();

// Add some books
$book1 = new Book("The Great Gatsby", "F. Scott Fitzgerald", "9780743273565", 3);
$book2 = new Book("To Kill a Mockingbird", "Harper Lee", "9780061120084", 2);
$book3 = new Book("1984", "George Orwell", "9780451524935", 1);

$library->addBook($book1);
$library->addBook($book2);
$library->addBook($book3);

// Add some magazines
$magazine1 = new Magazine("National Geographic", "National Geographic Society", "June 2023", "MAG123456", 5);
$magazine2 = new Magazine("Time", "Time USA", "May 2023", "MAG789012", 3);
$magazine3 = new Magazine("Scientific American", "Springer Nature", "April 2023", "MAG345678", 2);

$library->addMagazine($magazine1);
$library->addMagazine($magazine2);
$library->addMagazine($magazine3);

// Register some members
$member1 = new Member("M001", "John Doe", "john@example.com");
$member2 = new Member("M002", "Jane Smith", "jane@example.com");
$member3 = new Member("M003", "Bob Johnson", "bob@example.com");

$library->registerMember($member1);
$library->registerMember($member2);
$library->registerMember($member3);

// Demonstrate borrowing
$dueDate1 = new DateTime('+14 days');
$dueDate2 = new DateTime('+7 days');
$library->borrowItem($book1, $member1, $dueDate1);
$library->borrowItem($magazine2, $member2, $dueDate2);
$library->borrowItem($book3, $member3, $dueDate1);

// Demonstrate returning an item
$library->returnItem($book3, $member3);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --danger-color: #e74c3c;
            --warning-color: #f39c12;
            --dark-color: #2c3e50;
            --light-color: #ecf0f1;
            --gray-color: #95a5a6;
            --white-color: #ffffff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --border-radius: 8px;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--dark-color);
            background-color: #f5f7fa;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        header {
            background-color: var(--white-color);
            padding: 20px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h1 {
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .stats {
            display: flex;
            gap: 20px;
        }

        .stat-card {
            background-color: var(--white-color);
            padding: 15px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            text-align: center;
            min-width: 150px;
        }

        .stat-card h3 {
            color: var(--gray-color);
            font-size: 14px;
            margin-bottom: 5px;
        }

        .stat-card p {
            font-size: 24px;
            font-weight: bold;
            color: var(--dark-color);
        }

        .section {
            background-color: var(--white-color);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 25px;
            margin-bottom: 30px;
        }

        .section-title {
            color: var(--primary-color);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: var(--light-color);
            font-weight: 600;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .badge-success {
            background-color: var(--secondary-color);
            color: white;
        }

        .badge-warning {
            background-color: var(--warning-color);
            color: white;
        }

        .badge-danger {
            background-color: var(--danger-color);
            color: white;
        }

        .status-overdue {
            color: var(--danger-color);
            font-weight: 600;
        }

        .status-ontime {
            color: var(--secondary-color);
            font-weight: 600;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-success {
            background-color: var(--secondary-color);
            color: white;
        }

        .btn-success:hover {
            background-color: #27ae60;
        }

        .btn-danger {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        @media (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: flex-start;
            }

            .stats {
                width: 100%;
                margin-top: 15px;
                flex-wrap: wrap;
            }

            .stat-card {
                flex: 1 1 100px;
                min-width: auto;
            }

            table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <div>
                <h1>Library Management System</h1>
                <p>Manage your library collection and members efficiently</p>
            </div>
            <div class="stats">
                <div class="stat-card">
                    <h3>Total Items</h3>
                    <p><?php echo $library->getTotalItems(); ?></p>
                </div>
                <div class="stat-card">
                    <h3>Books</h3>
                    <p><?php echo count($library->getBooks()); ?></p>
                </div>
                <div class="stat-card">
                    <h3>Magazines</h3>
                    <p><?php echo count($library->getMagazines()); ?></p>
                </div>
                <div class="stat-card">
                    <h3>Members</h3>
                    <p><?php echo count($library->getMembers()); ?></p>
                </div>
            </div>
        </header>

        <div class="section">
            <h2 class="section-title">Library Collection</h2>
            <h3>Books</h3>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>ISBN</th>
                        <th>Available</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($library->getBooks() as $book): ?>
                        <tr>
                            <td><?php echo $book->getTitle(); ?></td>
                            <td><?php echo $book->getAuthor(); ?></td>
                            <td><?php echo $book->getIsbn(); ?></td>
                            <td><?php echo $book->getAvailableCopies(); ?></td>
                            <td class="actions">
                                <button class="btn btn-primary">View</button>
                                <button class="btn btn-success">Borrow</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h3 style="margin-top: 30px;">Magazines</h3>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Publisher</th>
                        <th>Issue</th>
                        <th>Available</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($library->getMagazines() as $magazine): ?>
                        <tr>
                            <td><?php echo $magazine->getTitle(); ?></td>
                            <td><?php echo $magazine->getPublisher(); ?></td>
                            <td><?php echo $magazine->getIssueNumber(); ?></td>
                            <td><?php echo $magazine->getAvailableCopies(); ?></td>
                            <td class="actions">
                                <button class="btn btn-primary">View</button>
                                <button class="btn btn-success">Borrow</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2 class="section-title">Library Members</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Borrowed Items</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($library->getMembers() as $member): ?>
                        <tr>
                            <td><?php echo $member->getMemberId(); ?></td>
                            <td><?php echo $member->getName(); ?></td>
                            <td><?php echo $member->getEmail(); ?></td>
                            <td><?php echo count($member->getBorrowedItems()); ?></td>
                            <td class="actions">
                                <button class="btn btn-primary">View</button>
                                <button class="btn btn-danger">Remove</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2 class="section-title">Borrowing Report</h2>
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Type</th>
                        <th>Borrowed By</th>
                        <th>Borrow Date</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($library->getBorrowings() as $borrowing):
                        $item = $borrowing->getItem();
                        $member = $borrowing->getMember();
                        $isOverdue = $borrowing->isOverdue();
                        $type = $item instanceof Book ? 'Book' : 'Magazine';
                    ?>
                        <tr>
                            <td><?php echo $item->getTitle(); ?></td>
                            <td><span class="badge <?php echo $type === 'Book' ? 'badge-primary' : 'badge-success'; ?>"><?php echo $type; ?></span></td>
                            <td><?php echo $member->getName(); ?></td>
                            <td><?php echo $borrowing->getBorrowDate()->format('Y-m-d'); ?></td>
                            <td><?php echo $borrowing->getDueDate()->format('Y-m-d'); ?></td>
                            <td class="<?php echo $isOverdue ? 'status-overdue' : 'status-ontime'; ?>">
                                <?php echo $isOverdue ? 'Overdue' : 'On Time'; ?>
                            </td>
                            <td class="actions">
                                <?php if (!$borrowing->getReturnDate()): ?>
                                    <button class="btn btn-success">Return</button>
                                <?php else: ?>
                                    <span class="badge badge-warning">Returned</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2 class="section-title">Recently Returned Items</h2>
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Type</th>
                        <th>Returned By</th>
                        <th>Return Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($library->getBorrowings() as $borrowing):
                        if ($borrowing->getReturnDate()) {
                            $item = $borrowing->getItem();
                            $member = $borrowing->getMember();
                            $type = $item instanceof Book ? 'Book' : 'Magazine';
                    ?>
                            <tr>
                                <td><?php echo $item->getTitle(); ?></td>
                                <td><span class="badge <?php echo $type === 'Book' ? 'badge-primary' : 'badge-success'; ?>"><?php echo $type; ?></span></td>
                                <td><?php echo $member->getName(); ?></td>
                                <td><?php echo $borrowing->getReturnDate()->format('Y-m-d H:i'); ?></td>
                            </tr>
                    <?php }
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>