<?php

declare(strict_types=1);

namespace Tests\Fixtures;

/**
 * Un objet du Donjon, réduit au minimum pour les tests : un nom, un poids.
 *
 * C'est volontairement la même idée que l'`Item` des katas POO : vos
 * collections vont trimballer des objets de jeu, pas des nombres abstraits.
 */
final class Item
{
    public function __construct(
        public readonly string $name,
        public readonly float $weight,
    ) {}
}
