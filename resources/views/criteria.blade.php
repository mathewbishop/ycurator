@extends('layouts.app')

@section('content')

<div class="container">

    <section class="criteria">
        <p class="no-keywords">You have not added any keywords.</p>
        <section style="margin-top:20px;">
            <div class="keyword-controls">
                <h2 class="criteria__section-title">Keywords</h2>
                <input type="text" id="keyword-input" class="input is-small is-rounded" placeholder="Type keyword..">
                <button id="btn-add-keyword" class="button is-small is-success is-rounded">Add Keyword</button>
            </div>
            <small class="is-block is-italic keyword-info-message" style="margin-bottom:20px;">Articles with these
                keywords in the title will
                be curated.</small>
            <button id="btn-del-keywords" class="button is-small is-rounded is-danger has-text-weight-bold"
                style="visibility:hidden;margin-bottom:10px;">Delete Selected
                (<span id="selected-count"></span>)</button>
            <ul id="keywords-list">

            </ul>
        </section>
        <section>
            <div class="threshold-controls">
                <h2 class="criteria__section-title">Comment Threshold</h2>
                <input type="text" id="threshold-input" name="threshold-input" class="input is-small is-rounded">
                <button id="btn-set-threshold" class="button is-small is-rounded is-success">Set Threshold</button>
            </div>
            <small class="is-block is-italic threshold-info-message">Articles with a comment count greater than the
                threshold number will be
                curated, irrespective of keyword match.</small>
        </section>
    </section>

</div>


@include('loading')


@endsection