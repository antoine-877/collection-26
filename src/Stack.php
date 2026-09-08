<?php

declare(strict_types=1);

namespace Collections;

use Countable;
use LogicException;
use UnderflowException;

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
        throw new LogicException('À implémenter');
    }

    /**
     * Retire et retourne l'élément au sommet.
     *
     * @throws UnderflowException si la pile est vide
     */
    public function pop(): mixed
    {
        // TODO : refuser si la pile est vide, sinon retirer le dernier élément.
        throw new LogicException('À implémenter');
    }

    /**
     * Regarde l'élément au sommet sans le retirer.
     *
     * @throws UnderflowException si la pile est vide
     */
    public function peek(): mixed
    {
        // TODO : comme pop(), mais on ne touche pas à la pile.
        throw new LogicException('À implémenter');
    }

    /** La pile est-elle vide ? */
    public function isEmpty(): bool
    {
        // TODO : une seule comparaison suffit.
        throw new LogicException('À implémenter');
    }

    /** Nombre d'éléments. Countable permet d'écrire `count($stack)`. */
    public function count(): int
    {
        // TODO : c'est l'interface Countable qui rend `count($stack)` possible.
        throw new LogicException('À implémenter');
    }
}
