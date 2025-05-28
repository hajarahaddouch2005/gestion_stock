@extends('layout.app')
@section('content')

<div class="container">
    <h2>Send Email</h2>
    <form action="{{ route('email.send') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" class="form-control" id="subject" name="subject" required>
            <label for="email">To:</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <label for="message">Message:</label>
            <textarea class="form-control" id="bodyMessage" name="bodyMessage" rows="5" required></textarea>
            <button type="submit" class="btn btn-primary mt-3">Send Email</button>
        </div>
    </form>
</div>

@endsection
