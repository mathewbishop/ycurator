<!DOCTYPE html>
<html lang="en">

@include('head')

<body>

    @include('header')

    @if (Auth::check())
    @include('nav')
    @endif

    <div class="container">

        <p class="no-results">You have not added any keywords.</p>

        <main class="criteria">
            <section class="keywords-section">
                <div class="keyword-controls">
                    <h2 class="keywords-section-title">Keywords</h2>
                    <button id="btn-add-keyword" class="keyword-control">Add +</button>
                    <button id="btn-del-keywords" class="keyword-control">Remove -</button>
                </div>
                <ul id="keywords-list">

                </ul>
                <div id="add-keyword-interface">
                    <button id="btn-cancel-addkeywords" class="button is-small is-danger">Cancel</button>
                    <button id="btn-confirm-addkeywords" class="button is-small is-success">Confirm</button>
                    <p style="margin-top:5px;">Type in a keyword and hit enter (or click the <span
                            style="font-weight:bold;color:white;">Add
                            Keyword</span> button below). When you're
                        done, click the <span style="font-weight:bold;color:white;">Confirm</span> button at the top to
                        add the keywords.</p>
                    <input type="text" id="keyword-input" class="input">
                    <button id="btn-add-keyword" class="button is-small is-success">Add Keyword</button>
                    <ul id="keywords-to-add">

                    </ul>
                </div>
            </section>
        </main>

    </div>

    @include('footer')

    @include('loading')
</body>

</html>