<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        @googlefonts

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    </head>


    <body class="font-sans antialiased">
        @livewire('navigation-menu')

        <!-- Page Content -->
        <main class="container my-5">
            {{ $slot }}
        </main>


        <script>
            (() => {
              'use strict'

              const storedTheme = localStorage.getItem('theme')

              const getPreferredTheme = () => {
                if (storedTheme) {
                  return storedTheme
                }

                return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
              }

              const setTheme = function (theme) {
                if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                  document.documentElement.setAttribute('data-bs-theme', 'dark')
                } else {
                  document.documentElement.setAttribute('data-bs-theme', theme)
                }
              }

              setTheme(getPreferredTheme())

              const showActiveTheme = theme => {
                const activeThemeIcon = document.querySelector('.theme-icon-active use')
                //const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
                //const svgOfActiveBtn = btnToActive.querySelector('svg use').getAttribute('href')

                document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
                  element.classList.remove('active')
                })

                //btnToActive.classList.add('active')
                //activeThemeIcon.setAttribute('href', svgOfActiveBtn)
              }

              window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                if (storedTheme !== 'light' || storedTheme !== 'dark') {
                  setTheme(getPreferredTheme())
                }
              })

              window.addEventListener('DOMContentLoaded', () => {
                showActiveTheme(getPreferredTheme())

                document.querySelectorAll('[data-bs-theme-value]')
                  .forEach(toggle => {
                    toggle.addEventListener('click', () => {
                      const theme = toggle.getAttribute('data-bs-theme-value')
                      localStorage.setItem('theme', theme)
                      setTheme(theme)
                      showActiveTheme(theme)
                    })
                  })
              })
            })()
        </script>

        @stack('modals')
        @stack('scripts')
    </body>

</html>
