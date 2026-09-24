<?php

declare(strict_types=1);

namespace Collections;

use Countable;
use LogicException;
use UnderflowException;

use function PHPUnit\Framework\isEmpty;

/**
 * ÉTAPE 1 — Une pile (LIFO : Last In, First Out).
 *
 * Le dernier élément empilé est le premier dépilé. C'est la pile d'assiettes :
 * on pose sur le dessus, on reprend sur le dessus. Dans le Donjon, c'est
 * l'historique des salles visitées : `pop()` fait demi-tour.
 *
 * Rangez les éléments dans un simple tableau PHP (`private array $elements`)
 * et travaillez toujours à la FIN du tableau : c'est là que `push` et `pop`
 * coûtent O(1). Les fonctions `array_pop()` et `array_key_last()` sont vos
 * amies.
 *
 * Tests : `composer test -- --group=etape-1`
 */
final class Stack implements Countable
{
    /** @var list<mixed> Les éléments, du plus ancien (index 0) au plus récent. */
    private array $elements = [];

    /** Empile un élément au sommet. */
    public function push(mixed $element): void
    {
        // TODO : ajouter l'élément à la fin de $this->elements.
        $this->elements[] = $element;
    }

    /**
     * Retire et retourne l'élément au sommet.
     *
     * @throws UnderflowException si la pile est vide
     */
    public function pop(): mixed
    {
        // TODO : refuser si la pile est vide, sinon retirer le dernier élément.
        if ($this->isEmpty()) {
            throw new \UnderflowException("La pile est déjà vide, impossible de retirer l'élément.");
        } else {
            return array_pop($this->elements);
        }
    }

    /**
     * Regarde l'élément au sommet sans le retirer.
     *
     * @throws UnderflowException si la pile est vide
     */
    public function peek(): mixed
    {
        // TODO : comme pop(), mais on ne touche pas à la pile.
        if ($this->isEmpty()) {
            throw new \UnderflowException("La pile est déjà vide, impossible de retirer l'élément.");
        }

        return $this->elements[count($this->elements) - 1];
    }

    /** La pile est-elle vide ? */
    public function isEmpty(): bool
    {
        // TODO : une seule comparaison suffit.
        return count($this->elements) === 0;
    }

    /** Nombre d'éléments. Countable permet d'écrire `count($stack)`. */
    public function count(): int
    {
        // TODO : c'est l'interface Countable qui rend `count($stack)` possible.
        return count($this->elements);
    }
}
