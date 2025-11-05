@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-start">
    <flux:heading class="font-semibold font-condensed text-3xl tracking-tight text-black" size="xl">{{ $title }}</flux:heading>
    <flux:subheading class="text-sm text-zinc-700 font-normal">{{ $description }}</flux:subheading>
</div>
