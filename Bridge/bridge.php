<?php
/**
 * Bridge Pattern Example in PHP
 * 
 * This example demonstrates separating the abstraction (Shape)
 * from its implementation (Color).
 * Both can evolve independently.
 */

/**
 * Implementor Interface
 * Defines the interface for implementation classes.
 */
interface Color {
    public function applyColor(): string;
}

/**
 * Concrete Implementors
 */
class RedColor implements Color {
    public function applyColor(): string {
        return "Red";
    }
}

class BlueColor implements Color {
    public function applyColor(): string {
        return "Blue";
    }
}

/**
 * Abstraction
 * Maintains a reference to the implementor.
 */
abstract class Shape {
    protected Color $color;

    public function __construct(Color $color) {
        $this->color = $color;
    }

    abstract public function draw(): void;
}

/**
 * Refined Abstractions
 */
class Circle extends Shape {
    public function draw(): void {
        echo "Drawing a Circle in " . $this->color->applyColor() . " color.\n";
    }
}

class Square extends Shape {
    public function draw(): void {
        echo "Drawing a Square in " . $this->color->applyColor() . " color.\n";
    }
}

/**
 * Client Code
 */
try {
    // Create shapes with different colors
    $redCircle = new Circle(new RedColor());
    $blueSquare = new Square(new BlueColor());

    $redCircle->draw();   // Output: Drawing a Circle in Red color.
    $blueSquare->draw();  // Output: Drawing a Square in Blue color.

} catch (Throwable $e) {
    echo "Error: " . $e->getMessage();
}
