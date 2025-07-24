addEventListener('DOMContentLoaded', () => {
// ... (Tu código JavaScript existente para clases, instancias, displayItems, etc.) ...
const notificationContainer = document.getElementById('notification-container');
// Clase para la notificación
class Notification {
constructor(message, type = 'info', duration = 5000) {
this.message = message;
this.type = type; // 'achievement', 'campaign', 'update', 'info'
this.duration = duration; // duración en milisegundos
this.element = this.createNotificationElement();
}
createNotificationElement() {
const div = document.createElement('div');
div.classList.add('notification', this.type);
div.innerHTML = `
<span>${this.message}</span>
<span class="close-btn">&times;</span>
`;
const closeBtn = div.querySelector('.close-btn');
closeBtn.addEventListener('click', () => this.hide());
return div;
}
show() {
notificationContainer.appendChild(this.element);
// Pequeño retardo para permitir la transición CSS
setTimeout(() => {
this.element.classList.add('show');
}, 10);
if (this.duration > 0) {
setTimeout(() => this.hide(), this.duration);
}
}
hide() {
this.element.classList.remove('show');
// Eliminar del DOM después de que termine la transición
this.element.addEventListener('transitionend', () => {
if (this.element.parentNode) {
this.element.parentNode.removeChild(this.element);
}
}, { once: true }); // Para que el evento se dispare solo una vez
}
}
// --- Implementación de Notificaciones Instantáneas ---
// 1. Notificaciones sobre Logros Alcanzados (ejemplo con un temporizador)
let achievements = [
"¡Hemos alcanzado nuestro objetivo de $10,000 para el Proyecto Agua Potable!",
"¡Más de 500 niños inscritos en el programa Educación para Todos!",
"¡Primera campaña de vacunación comunitaria completada con éxito!"
];
let achievementIndex = 0;
const showAchievementNotification = () => {
if (achievements.length > 0) {
const message = achievements[achievementIndex];
new Notification(message, 'achievement', 7000).show();
achievementIndex = (achievementIndex + 1) % achievements.length;
}
};
// Mostrar un logro cada 15 segundos
setInterval(showAchievementNotification, 15000);
// Mostrar el primer logro al cargar la página
showAchievementNotification();
// 2. Notificaciones sobre Campañas en Curso (ejemplo de interacción del usuario o carga inicial)
const showCampaignNotification = (campaignName) => {
const message = `¡Únete a nuestra campaña: "${campaignName}"! Tu ayuda es vital.`;
new Notification(message, 'campaign', 8000).show();
};
// Simular que una nueva campaña se anuncia después de un tiempo
setTimeout(() => {
showCampaignNotification("Donación de útiles escolares");
}, 10000);
// Puedes vincular esto a eventos específicos, por ejemplo, al cargar la página de proyectos
document.getElementById('show-projects').addEventListener('click', () => {
// Simular una notificación de campaña al ver proyectos
showCampaignNotification("Construyendo Futuros Brillantes");
});
// 3. Actualizaciones en Tiempo Real sobre el Progreso de las Donaciones
// (Simulación de progreso de donaciones y notificaciones)
let currentDonationGoal = 5000; // Meta de una campaña de donación
let currentDonationAmount = 0; // Cantidad actual recaudada
// Simular nuevas donaciones llegando
const simulateDonationProgress = () => {
const newDonation = Math.floor(Math.random() * 500) + 50; // Donaciones entre 50 y 550
currentDonationAmount += newDonation;
const percentage = ((currentDonationAmount / currentDonationGoal) * 100).toFixed(0);
let message = `¡Nueva donación de $${newDonation}! Total recaudado: $${currentDonationAmount} de $${currentDonationGoal} (${percentage}%)`;
let type = 'update';
if (currentDonationAmount >= currentDonationGoal) {
message = `¡Meta de donación alcanzada! Hemos recaudado $${currentDonationAmount}. ¡Gracias!`;
type = 'achievement'; // Cambiar a tipo logro si se alcanza la meta
// Opcional: detener la simulación una vez alcanzada la meta
// clearInterval(donationInterval);
} else if (currentDonationAmount > currentDonationGoal * 0.8 && currentDonationAmount < currentDonationGoal) {
message = `¡Casi llegamos! Hemos recaudado $${currentDonationAmount} de $${currentDonationGoal}. ¡Falta poco!`;
type = 'campaign'; // Usar tipo campaña para cerca de la meta
}
new Notification(message, type, 9000).show();
};
// Simular nuevas donaciones cada 7 segundos
const donationInterval = setInterval(simulateDonationProgress, 7000);
// Detener la simulación de donaciones después de un tiempo para evitar notificaciones infinitas
// setTimeout(() => {
// clearInterval(donationInterval);
// new Notification("La simulación de donaciones ha finalizado.", 'info', 5000).show();
// }, 60000); // Detener después de 1 minuto
});