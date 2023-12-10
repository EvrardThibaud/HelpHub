@include('includes.header')
<style>
body{
    background-color : orange
} 

#qui_tourne{
    animation: rotate 5s linear infinite;
}

@keyframes rotate {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}
</style>
<h1>Bonjour monsieur bienvenue sur votre page personnalisée</h1>
<img id="qui_tourne" src="https://www.pngall.com/wp-content/uploads/11/Worms-Game-PNG-Image-File.png" alt="">
<h3>Train <3</h3>