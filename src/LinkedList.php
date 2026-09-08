<?php

declare(strict_types=1);

namespace Collections;

use LogicException;
use OutOfRangeException;

/**
 * BONUS — une liste chaînée : même contrat qu'`ArrayList`, autre mécanique.
 *
 * Ici les éléments ne sont pas rangés côte à côte en mémoire : chaque `Node`
 * pointe vers le suivant, et c'est tout. Conséquence : pour lire le 50e
 * élément il faut traverser les 49 précédents (O(n)), mais retirer un maillon
 * ne décale rien — on rebranche juste un pointeur.
 *
 * `$head` est un maillon **sentinelle** qui ne contient aucune valeur : le
 * premier vrai élément est `$this->head->getNext()`. Ça évite d'écrire un `if`
 * particulier pour le début de la liste.
 *
 * Les tests sont volontairement les mêmes que ceux d'`ArrayList` : c'est la
 * démonstration qu'une interface est bien un contrat, pas une implémentation.
 *
 * Tests : `composer test -- --group=bonus`
 */
final class LinkedList implements ListInterface
{
    private Node $head;

    private int $size = 0;

    public function __construct()
    {
        $this->head = new Node();
    }

    public function push(mixed $element): void
    {
        // TODO : avancer jusqu'au dernier maillon, puis y accrocher un new Node().
        throw new LogicException('À implémenter');
    }

    public function get(int $index): mixed
    {
        throw new LogicException('À implémenter');
    }

    public function set(int $index, mixed $element): void
    {
        throw new LogicException('À implémenter');
    }

    public function remove(int $index): void
    {
        // TODO : s'arrêter sur le maillon situé JUSTE AVANT celui à retirer,
        // puis le faire pointer vers le maillon d'après. Ne pas oublier $size.
        throw new LogicException('À implémenter');
    }

    public function indexOf(mixed $element): int
    {
        throw new LogicException('À implémenter');
    }

    public function includes(mixed $element): bool
    {
        throw new LogicException('À implémenter');
    }

    public function size(): int
    {
        throw new LogicException('À implémenter');
    }

    public function isEmpty(): bool
    {
        throw new LogicException('À implémenter');
    }

    public function clear(): void
    {
        // TODO : une seule ligne suffit pour oublier toute la chaîne.
        throw new LogicException('À implémenter');
    }

    /** @return list<mixed> */
    public function toArray(): array
    {
        throw new LogicException('À implémenter');
    }

    public function __toString(): string
    {
        throw new LogicException('À implémenter');
    }

    /**
     * Cadeau de la maison : vérifie qu'un index existe. Rien à écrire ici.
     *
     * @throws OutOfRangeException si l'index sort de la liste
     */
    private function guardIndex(int $index): void
    {
        if ($index < 0 || $index >= $this->size) {
            throw new OutOfRangeException("L'index {$index} n'existe pas dans cette liste.");
        }
    }
}
