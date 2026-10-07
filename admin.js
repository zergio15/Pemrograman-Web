const adminSafe = value => String(value ?? "").replace(/[&<>"']/g, c => ({"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;"}[c]));
function adminLogout(){sessionStorage.removeItem("rodacare_session");window.location.href="admin-login.html";}
document.addEventListener("DOMContentLoaded",()=>{
  const session = JSON.parse(sessionStorage.getItem("rodacare_session") || "null");
  if(!session || session.role !== "admin"){window.location.replace("admin-login.html");return;}
  const users=JSON.parse(localStorage.getItem("rodacare_users")||"[]");
  const vehicles=JSON.parse(localStorage.getItem("rodacare_vehicles")||"[]");
  const services=JSON.parse(localStorage.getItem("rodacare_services")||"[]");
  document.getElementById("adminUserCount").textContent=users.length;
  document.getElementById("adminVehicleCount").textContent=vehicles.length;
  document.getElementById("adminServiceCount").textContent=services.length;
  document.getElementById("adminUserRows").innerHTML=users.length?users.map(u=>`<tr><td>${adminSafe(u.name)}</td><td>${adminSafe(u.email)}</td><td>${u.createdAt?new Date(u.createdAt).toLocaleDateString("id-ID"):"—"}</td></tr>`).join(""):'<tr><td colspan="3">Belum ada pengguna terdaftar.</td></tr>';
  document.getElementById("adminVehicleRows").innerHTML=vehicles.length?vehicles.map(v=>`<tr><td>${adminSafe(v.name)}</td><td>${adminSafe(v.plate)}</td><td>${adminSafe(v.type)}</td></tr>`).join(""):'<tr><td colspan="3">Belum ada data kendaraan.</td></tr>';
  document.getElementById("adminServiceRows").innerHTML=services.length?services.map(s=>`<tr><td>${adminSafe(s.vehicle)}</td><td>${adminSafe(s.type)}</td><td>${adminSafe(s.date)}</td><td>${adminSafe(s.status)}</td></tr>`).join(""):'<tr><td colspan="4">Belum ada data servis.</td></tr>';
});
