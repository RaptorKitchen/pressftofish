<div class="dialogue-window" style="display: none;">
    <div class="dialogue-text">{{ $text }}</div>
    <div class="dialogue-options">
        @if ($options)
            @foreach ($options as $option)
                <button class="dialogue-option" data-action="{{ $option['action'] }}">{{ $option['text'] }}</button>
            @endforeach
        @endif
    </div>
</div>

<script>
    document.querySelectorAll('.dialogue-option').forEach(button => {
        button.addEventListener('click', function() {
            const action = this.getAttribute('data-action');
            // Perform the action associated with the option
            // This might involve showing more dialogue or performing some game action
            console.log('Action:', action);
        });
    });
</script>
