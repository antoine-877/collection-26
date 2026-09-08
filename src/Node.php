<?php

declare(strict_types=1);

namespace Collections;

/**
 * BONUS — un maillon de la chaîne, utilisé par `LinkedList`.
 *
 * Il connaît sa valeur et le maillon suivant. Il ne connaît ni le précédent,
 * ni la liste : c'est tout l'intérêt, et toute la limite, d'une liste chaînée.
 *
 * Celui-là est offert, entièrement écrit : rien à faire ici.
 */
final class Node
{
    public function __construct(
        private mixed $element = null,
        private ?Node $next = null,
    ) {}

    public function getElement(): mixed
    {
        return $this->element;
    }

    public function setElement(mixed $element): void
    {
        $this->element = $element;
    }

    public function getNext(): ?Node
    {
        return $this->next;
    }

    public function setNext(?Node $next): void
    {
        $this->next = $next;
    }
}
