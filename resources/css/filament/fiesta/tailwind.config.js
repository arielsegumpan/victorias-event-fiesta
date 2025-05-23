import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/Fiesta/**/*.php',
        './resources/views/filament/fiesta/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}
