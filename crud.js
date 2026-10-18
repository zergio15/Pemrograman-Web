
const readData = (key) => JSON.parse(localStorage.getItem(key) || "[]");
const saveData = (key, data) => localStorage.setItem(key, JSON.stringify(data));

let vehicles = readData("rodacare_vehicles");
let services = readData("rodacare_services");

const $ = (id) => document.getElementById(id);

function safe(value) {
    return String(value).replace(/[&<>"']/g, c => ({
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;",
        '"': "&quot;",
        "'": "&#39;"
    }[c]));
}

// ==========================================
// UPDATE JUMLAH DATA
// ==========================================

function updateCounts() {
    $("vehicleCount").textContent = vehicles.length;
    $("serviceCount").textContent = services.length;
}

// ==========================================
// CRUD KENDARAAN
// ==========================================

function renderVehicles() {
    const body = $("vehicleRows");

    body.innerHTML = vehicles.length
        ? vehicles.map(v => `
            <tr>
                <td>${safe(v.name)}</td>
                <td>${safe(v.plate)}</td>
                <td>${safe(v.type)}</td>
                <td>
                    <div class="table-action">
                        <button
                            class="btn-small edit-btn"
                            onclick="editVehicle('${v.id}')">
                            Edit
                        </button>

                        <button
                            class="btn-small delete-btn"
                            onclick="deleteVehicle('${v.id}')">
                            Hapus
                        </button>
                    </div>
                </td>
            </tr>
        `).join("")
        : `
            <tr>
                <td colspan="4">
                    Belum ada data kendaraan.
                    Klik "Tambah Kendaraan" untuk mulai.
                </td>
            </tr>
        `;

    updateCounts();
}

function openVehicleForm() {
    $("vehicleForm").classList.remove("hidden");
    $("vehicleId").value = "";
    $("vehicleForm").reset();
    $("vehicleName").focus();
}

function closeVehicleForm() {
    $("vehicleForm").classList.add("hidden");
}

$("vehicleForm").addEventListener("submit", e => {
    e.preventDefault();

    const id = $("vehicleId").value;

    const item = {
        id: id || String(Date.now()),
        name: $("vehicleName").value.trim(),
        plate: $("vehiclePlate").value.trim(),
        type: $("vehicleType").value.trim()
    };

    if (item.name.length < 3) {
        alert("Nama kendaraan minimal 3 karakter.");
        $("vehicleName").focus();
        return;
    }

    if (id) {
        vehicles = vehicles.map(v => v.id === id ? item : v);
    } else {
        vehicles.push(item);
    }

    saveData("rodacare_vehicles", vehicles);
    renderVehicles();
    closeVehicleForm();
});

function editVehicle(id) {
    const v = vehicles.find(x => x.id === id);

    if (!v) return;

    $("vehicleId").value = v.id;
    $("vehicleName").value = v.name;
    $("vehiclePlate").value = v.plate;
    $("vehicleType").value = v.type;

    $("vehicleForm").classList.remove("hidden");

    $("vehicleForm").scrollIntoView({
        behavior: "smooth",
        block: "center"
    });
}

function deleteVehicle(id) {
    if (confirm("Hapus data kendaraan ini?")) {
        vehicles = vehicles.filter(v => v.id !== id);

        saveData("rodacare_vehicles", vehicles);
        renderVehicles();
    }
}

// ==========================================
// CRUD SERVIS
// ==========================================

function renderServices() {
    const body = $("serviceRows");

    body.innerHTML = services.length
        ? services.map(s => `
            <tr>
                <td>${safe(s.vehicle)}</td>
                <td>${safe(s.type)}</td>
                <td>${safe(s.date)}</td>
                <td>
                    <span class="status ${safe(
                        s.status.toLowerCase().replace(/\s+/g, "-")
                    )}">
                        ${safe(s.status)}
                    </span>
                </td>
                <td>
                    <div class="table-action">
                        <button
                            class="btn-small edit-btn"
                            onclick="editService('${s.id}')">
                            Edit
                        </button>

                        <button
                            class="btn-small delete-btn"
                            onclick="deleteService('${s.id}')">
                            Hapus
                        </button>
                    </div>
                </td>
            </tr>
        `).join("")
        : `
            <tr>
                <td colspan="5">
                    Belum ada data servis.
                    Klik "Tambah Servis" untuk mulai.
                </td>
            </tr>
        `;

    updateCounts();
}

function openServiceForm() {
    $("serviceForm").classList.remove("hidden");
    $("serviceId").value = "";
    $("serviceForm").reset();

    $("serviceDate").value = new Date().toISOString().slice(0, 10);

    $("serviceVehicle").focus();
}

function closeServiceForm() {
    $("serviceForm").classList.add("hidden");
}

$("serviceForm").addEventListener("submit", e => {
    e.preventDefault();

    const id = $("serviceId").value;

    const item = {
        id: id || String(Date.now()),
        vehicle: $("serviceVehicle").value.trim(),
        type: $("serviceType").value.trim(),
        date: $("serviceDate").value,
        status: $("serviceStatus").value
    };

    if (id) {
        services = services.map(s => s.id === id ? item : s);
    } else {
        services.push(item);
    }

    saveData("rodacare_services", services);
    renderServices();
    closeServiceForm();
});

function editService(id) {
    const s = services.find(x => x.id === id);

    if (!s) return;

    $("serviceId").value = s.id;
    $("serviceVehicle").value = s.vehicle;
    $("serviceType").value = s.type;
    $("serviceDate").value = s.date;
    $("serviceStatus").value = s.status;

    $("serviceForm").classList.remove("hidden");

    $("serviceForm").scrollIntoView({
        behavior: "smooth",
        block: "center"
    });
}

function deleteService(id) {
    if (confirm("Hapus data servis ini?")) {
        services = services.filter(s => s.id !== id);

        saveData("rodacare_services", services);
        renderServices();
    }
}

// ==========================================
// PENCARIAN DATA SERVIS
// ==========================================

function searchServicePrompt() {
    const keyword = prompt(
        "Masukkan nama kendaraan yang ingin dicari:"
    );

    if (keyword === null) return;

    const pencarian = keyword.trim().toLowerCase();

    if (pencarian === "") {
        alert("Nama kendaraan tidak boleh kosong.");
        return;
    }

    const hasil = services.filter(service =>
        service.vehicle.toLowerCase().includes(pencarian)
    );

    if (hasil.length > 0) {
        const pesan = hasil.map((service, index) =>
            (index + 1) + ". " +
            service.vehicle + " - " +
            service.type + " (" +
            service.status + ")"
        ).join("\n");

        alert(
            "Ditemukan " + hasil.length +
            " data servis:\n\n" + pesan
        );
    } else {
        alert("Data servis tidak ditemukan.");
    }
}

// ==========================================
// VALIDASI INPUT NAMA KENDARAAN
// ==========================================

$("vehicleName").addEventListener("input", function () {
    const nama = this.value.trim();

    if (nama.length > 0 && nama.length < 3) {
        this.setCustomValidity(
            "Nama kendaraan minimal 3 karakter."
        );
    } else {
        this.setCustomValidity("");
    }
});

// ==========================================
// EVENT PERUBAHAN STATUS SERVIS
// ==========================================

$("serviceStatus").addEventListener("change", function () {
    console.log("Status servis dipilih: " + this.value);
});

// ==========================================
// INISIALISASI DASHBOARD
// ==========================================

document.addEventListener("DOMContentLoaded", () => {
    const session = JSON.parse(
        sessionStorage.getItem("rodacare_session") || "null"
    );

    if (!session || session.role !== "user") {
        window.location.replace("login.html");
        return;
    }

    const name = session.name || "Pengguna Roda Care";

    const nameEl = $("sidebarUserName");
    const avatarEl = $("userAvatar");
    const welcomeEl = $("welcomeUser");

    if (nameEl) {
        nameEl.textContent = name;
    }

    if (avatarEl) {
        avatarEl.textContent = name
            .split(/\s+/)
            .slice(0, 2)
            .map(part => part.charAt(0))
            .join("")
            .toUpperCase();
    }

    if (welcomeEl) {
        welcomeEl.textContent =
            "Halo, " + name.split(/\s+/)[0] + "! 👋";
    }

    renderVehicles();
    renderServices();
});
