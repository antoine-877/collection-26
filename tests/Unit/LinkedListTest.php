<?php

declare(strict_types=1);

use Collections\LinkedList;
use Collections\ListInterface;
use Tests\Fixtures\Item;

/** La même compagnie de héros, mais rangée dans une liste chaînée. */
function compagnie(): LinkedList
{
    $liste = new LinkedList();
    $liste->push('Arthur');
    $liste->push('Perceval');
    $liste->push('Merlin');
    $liste->push('Guenièvre');

    return $liste;
}

describe('Bonus — LinkedList', function (): void {
    it('respecte le même contrat qu\'ArrayList', function (): void {
        expect(new LinkedList())->toBeInstanceOf(ListInterface::class);
    });

    it('démarre vide', function (): void {
        $liste = new LinkedList();

        expect($liste->isEmpty())->toBeTrue()
            ->and($liste->size())->toBe(0)
            ->and($liste->toArray())->toBe([]);
    });

    it('ajoute et relit par index', function (): void {
        $liste = compagnie();

        expect($liste->size())->toBe(4)
            ->and($liste->get(0))->toBe('Arthur')
            ->and($liste->get(2))->toBe('Merlin')
            ->and($liste->get(3))->toBe('Guenièvre');
    });

    it('remplace un élément avec set()', function (): void {
        $liste = compagnie();
        $liste->set(0, 'Lancelot');
        $liste->set(3, 'Morgane');

        expect($liste->toArray())->toBe(['Lancelot', 'Perceval', 'Merlin', 'Morgane']);
    });

    it('retire le premier maillon', function (): void {
        $liste = compagnie();
        $liste->remove(0);

        expect($liste->size())->toBe(3)
            ->and($liste->toArray())->toBe(['Perceval', 'Merlin', 'Guenièvre']);
    });

    it('retire un maillon du milieu', function (): void {
        $liste = compagnie();
        $liste->remove(2);

        expect($liste->toArray())->toBe(['Arthur', 'Perceval', 'Guenièvre']);
    });

    it('retire le dernier maillon', function (): void {
        $liste = compagnie();
        $liste->remove(3);

        expect($liste->toArray())->toBe(['Arthur', 'Perceval', 'Merlin']);
    });

    it('trouve l\'index d\'un élément, ou -1', function (): void {
        $liste = compagnie();

        expect($liste->indexOf('Arthur'))->toBe(0)
            ->and($liste->indexOf('Guenièvre'))->toBe(3)
            ->and($liste->indexOf('Mordred'))->toBe(-1)
            ->and($liste->includes('Merlin'))->toBeTrue()
            ->and($liste->includes('Mordred'))->toBeFalse();
    });

    it('se vide avec clear()', function (): void {
        $liste = compagnie();
        $liste->clear();

        expect($liste->isEmpty())->toBeTrue()
            ->and($liste->size())->toBe(0)
            ->and($liste->toArray())->toBe([]);
    });

    it('s\'affiche en JSON lisible', function (): void {
        $liste = new LinkedList();
        $liste->push('Arthur');
        $liste->push('Merlin');

        expect((string) $liste)->toBe("[\n    \"Arthur\",\n    \"Merlin\"\n]");
    });

    it('range aussi des objets', function (): void {
        $sac = new LinkedList();
        $sac->push(new Item('Épée longue', 3.5));

        expect($sac->get(0)->name)->toBe('Épée longue');
    });

    it('supporte 100 ajouts puis 100 retraits', function (): void {
        $liste = new LinkedList();

        for ($i = 0; $i < 100; ++$i) {
            $liste->push($i);
        }

        expect($liste->size())->toBe(100)
            ->and($liste->get(99))->toBe(99);

        for ($i = 0; $i < 100; ++$i) {
            $liste->remove(0);
        }

        expect($liste->isEmpty())->toBeTrue();
    });

    it('refuse un get() hors limites', function (): void {
        compagnie()->get(9);
    })->throws(OutOfRangeException::class);

    it('refuse un remove() hors limites', function (): void {
        compagnie()->remove(-1);
    })->throws(OutOfRangeException::class);
})->group('bonus');
