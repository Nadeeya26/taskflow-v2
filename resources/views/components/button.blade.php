<button {{ $attributes->merge(['type' => 'submit', 'class' => 'tf-button primary disabled:opacity-50']) }}>
    {{ $slot }}
</button>
