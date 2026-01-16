<?php
/**
 * State Design Pattern Example in PHP
 * PHP 8+
 */

// State interface
interface State {
    public function publish(Document $document): void;
    public function getName(): string;
}

// Concrete State: Draft
class DraftState implements State {
    public function publish(Document $document): void {
        echo "Document moved from Draft to Moderation.\n";
        $document->setState(new ModerationState());
    }

    public function getName(): string {
        return "Draft";
    }
}

// Concrete State: Moderation
class ModerationState implements State {
    public function publish(Document $document): void {
        echo "Document approved and published.\n";
        $document->setState(new PublishedState());
    }

    public function getName(): string {
        return "Moderation";
    }
}

// Concrete State: Published
class PublishedState implements State {
    public function publish(Document $document): void {
        echo "Document is already published. No further changes.\n";
    }

    public function getName(): string {
        return "Published";
    }
}

// Context class
class Document {
    private State $state;

    public function __construct() {
        // Initial state is Draft
        $this->state = new DraftState();
    }

    public function setState(State $state): void {
        $this->state = $state;
    }

    public function publish(): void {
        $this->state->publish($this);
    }

    public function getStateName(): string {
        return $this->state->getName();
    }
}

// ----------------------
// Example usage
// ----------------------
try {
    $doc = new Document();
    echo "Current State: " . $doc->getStateName() . "\n";
    $doc->publish();

    echo "Current State: " . $doc->getStateName() . "\n";
    $doc->publish();

    echo "Current State: " . $doc->getStateName() . "\n";
    $doc->publish();
} catch (Throwable $e) {
    echo "Error: " . $e->getMessage();
}
