document.addEventListener("DOMContentLoaded", () => {
	const burgerMenu = document.querySelector(".burger-menu");
	const navLinks = document.querySelector(".nav-links");

	const items = [
		{ text: "Accueil", icon: "fa-house", link: "./" },
		{ text: "Blog", icon: "fa-square-rss", link: "./blog.html" },
		{ text: "Ressources", icon: "fa-circle-info", link: "./ressources.html" },
		{ text: "Contact", icon: "fa-envelope", link: "./contact.html" },
	];

	const ul = document.createElement("ul");
	ul.classList.add("nav-list");

	items.forEach((item) => {
		const li = document.createElement("li");
		const a = document.createElement("a");
		const icon = document.createElement("i");

		a.href = item.link;
		icon.classList.add("fa-solid", `fa-${item.icon}`);
		a.appendChild(icon);
		a.appendChild(document.createTextNode(` ${item.text}`));
		li.appendChild(a);
		ul.appendChild(li);
	});

	burgerMenu.addEventListener("click", () => {
		if (navLinks.innerHTML === "") {
			navLinks.appendChild(ul);
		} else {
			navLinks.innerHTML = ""; // Supprime le contenu existant pour refermer le menu
		}
		navLinks.classList.toggle("active");
		burgerMenu.classList.toggle("change");
	});
});
