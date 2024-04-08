<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-1.5 bg-purple-800 text-white rounded-md hover:bg-blue-700']) }}>
    {{ $slot }}
</button>
