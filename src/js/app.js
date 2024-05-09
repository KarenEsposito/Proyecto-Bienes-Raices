document.addEventListener('DOMContentLoaded', function(){
    eventListeners();

    darkMode();
});

function darkMode(){
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    if(prefiereDarkMode.matches){
        document.body.classList.add('dark-mode');
    }else{
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function(){
        if(prefiereDarkMode.matches){
            document.body.classList.add('dark-mode');
        }else{
            document.body.classList.remove('dark-mode');
        } 
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode');
    });

}
function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');

    if(navegacion.classList.contains('mostrar')){
        navegacion.classList.remove('mostrar');
    }else{
        navegacion.classList.add('mostrar');
    }
}

// Importa las funciones necesarias del SDK de Firebase
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";

// Configuración de tu proyecto Firebase
const firebaseConfig = {
  apiKey: "tu-api-key",
  authDomain: "tu-auth-domain",
  projectId: "tu-project-id",
  storageBucket: "tu-storage-bucket",
  messagingSenderId: "tu-messaging-sender-id",
  appId: "tu-app-id",
  measurementId: "tu-measurement-id" // opcional
};

// Inicializa Firebase con la configuración de tu proyecto
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
