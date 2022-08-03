<script>
    @if(auth()->check())
    localStorage.setItem('auth', '1')
    @else
    localStorage.removeItem('auth')
    @endif
</script>
