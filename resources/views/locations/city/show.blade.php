<?php /** @var $record */ ?>
<h1>{{ $record->name ?? ucfirst($pageKey) }}</h1>
{!! $data->content ?? '<p>No overview yet.</p>' !!}
