let mix = require('laravel-mix')

mix
  .setPublicPath('dist')
  .js('Assets/js/library.js', 'js')
  .sass('Assets/sass/library.scss', 'css')
