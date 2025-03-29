@extends('layouts.app')

@section('title', 'Alternatif')

@section('content')

    <x-table title="Daftar Alternatif" createRoute="alternative.create" showRoute="alternative.show"
        editRoute="alternative.edit" deleteRoute="alternative.destroy" :data="$alternatives" :columns="array_merge(
            [['label' => 'Nama', 'field' => 'name']],
            $alternatives
                ->map(
                    fn($alt) => $criterias->map(
                        fn($criteria) => [
                            'label' => $criteria->name,
                            'field' => $alt->values->firstWhere('criteria_id', $criteria->id)->value ?? 0,
                            'php' => true,
                        ]
                    )->toArray()
                )
                ->flatten(1)
                ->toArray()
        )" />

@endsection
