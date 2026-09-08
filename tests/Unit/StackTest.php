<?php

declare(strict_types=1);

use Collections\Stack;

describe('Étape 1 — Stack', function (): void {
    it('démarre vide', function (): void {
        $salles = new Stack();

        expect($salles->isEmpty())->toBeTrue()
            ->and($salles->count())->toBe(0);
    });

    it('empile et se souvient du nombre de salles visitées', function (): void {
        $salles = new Stack();
        $salles->push('Entrée');
        $salles->push('Couloir');
        $salles->push('Salle du trône');

        expect($salles->isEmpty())->toBeFalse()
            ->and($salles->count())->toBe(3);
    });

    it('dépile dans l\'ordre inverse de l\'empilement (LIFO)', function (): void {
        $salles = new Stack();
        $salles->push('Entrée');
        $salles->push('Couloir');
        $salles->push('Salle du trône');

        expect($salles->pop())->toBe('Salle du trône')
            ->and($salles->pop())->toBe('Couloir')
            ->and($salles->pop())->toBe('Entrée')
            ->and($salles->isEmpty())->toBeTrue();
    });

    it('regarde le sommet sans le retirer avec peek()', function (): void {
        $salles = new Stack();
        $salles->push('Entrée');
        $salles->push('Couloir');

        expect($salles->peek())->toBe('Couloir')
            ->and($salles->peek())->toBe('Couloir')
            ->and($salles->count())->toBe(2);
    });

    it('est Countable : count($stack) fonctionne', function (): void {
        $heros = new Stack();
        $heros->push('Arthur');
        $heros->push('Perceval');

        expect($heros)->toBeInstanceOf(Countable::class)
            ->and(count($heros))->toBe(2);
    });

    it('accepte n\'importe quel type de valeur', function (): void {
        $pile = new Stack();
        $pile->push(42);
        $pile->push(['nom' => 'Épée', 'poids' => 3.5]);

        expect($pile->pop())->toBe(['nom' => 'Épée', 'poids' => 3.5])
            ->and($pile->pop())->toBe(42);
    });

    it('refuse de dépiler une pile vide', function (): void {
        (new Stack())->pop();
    })->throws(UnderflowException::class);

    it('refuse de regarder le sommet d\'une pile vide', function (): void {
        (new Stack())->peek();
    })->throws(UnderflowException::class);

    it('redevient vide quand on a tout dépilé', function (): void {
        $pile = new Stack();

        for ($i = 0; $i < 50; ++$i) {
            $pile->push($i);
        }

        expect($pile->count())->toBe(50);

        for ($i = 49; $i >= 0; --$i) {
            expect($pile->pop())->toBe($i);
        }

        expect($pile->isEmpty())->toBeTrue();
    });
})->group('etape-1');
