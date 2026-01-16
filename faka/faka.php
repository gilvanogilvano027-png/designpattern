<?php
/**
 * Example of the Facade Design Pattern in PHP
 * This example simulates a simple order processing system.
 */

/** Subsystem 1: Inventory Management */
class Inventory {
    public function checkStock(string $product, int $quantity): bool {
        echo "Checking stock for {$quantity} unit(s) of '{$product}'...\n";
        // Simulate stock availability
        return $quantity <= 10;
    }
}

/** Subsystem 2: Payment Processing */
class Payment {
    public function processPayment(float $amount): bool {
        echo "Processing payment of \${$amount}...\n";
        // Simulate payment success
        return $amount > 0;
    }
}

/** Subsystem 3: Shipping Service */
class Shipping {
    public function arrangeShipping(string $product, int $quantity): void {
        echo "Arranging shipping for {$quantity} unit(s) of '{$product}'...\n";
    }
}

/** Facade Class: Simplifies interaction with subsystems */
class OrderFacade {
    private Inventory $inventory;
    private Payment $payment;
    private Shipping $shipping;

    public function __construct() {
        $this->inventory = new Inventory();
        $this->payment = new Payment();
        $this->shipping = new Shipping();
    }

    public function placeOrder(string $product, int $quantity, float $amount): void {
        echo "Starting order process...\n";

        if (!$this->inventory->checkStock($product, $quantity)) {
            echo "Order failed: Insufficient stock.\n";
            return;
        }

        if (!$this->payment->processPayment($amount)) {
            echo "Order failed: Payment error.\n";
            return;
        }

        $this->shipping->arrangeShipping($product, $quantity);
        echo "Order placed successfully!\n";
    }
}

/** Client Code */
$order = new OrderFacade();
$order->placeOrder("Laptop", 2, 1500.00);

echo "\n";
$order->placeOrder("Smartphone", 15, 7500.00); // Will fail due to stock
