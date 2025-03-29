@extends('layouts.navbar')

@section('content')
    <x-table 
        title="Daftar Alternatif"
        createRoute="alternative.create"
        showRoute="alternative.show"
        editRoute="alternative.edit"
        deleteRoute="alternative.destroy"
        :data="$alternatives"
        :columns="
            array_merge(
                [['label' => 'Nama', 'field' => 'name']], 
                $criterias->map(fn($c) => ['label' => $c->name, 'field' => 'criteria_' . $c->id])->toArray()
            )
        "
    />
@endsection
