import DropIcon from "./DropIcon";
import "./index.css";
import MainLayout from "./MainLayout";
const bodyElement = document.body;
if (bodyElement) {
  const customDiv = document.createElement("div");
  customDiv.id = "wcf--custom-icon--toast";
  bodyElement.appendChild(customDiv);
}

document.body.classList.add("wcfcbi2025");
wp.element.render(
  <MainLayout />,
  document.getElementById("wcf--custom-icons-meta-box")
);
