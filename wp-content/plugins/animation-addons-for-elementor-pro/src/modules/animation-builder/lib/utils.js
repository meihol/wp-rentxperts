import { clsx } from "clsx";
import { twMerge } from "tailwind-merge";

export function cn(...inputs) {
  return twMerge(clsx(inputs));
}

export const removeFromDynamicCopy = (str) => {
  const regex = /\s*copy(_\d+)?$/i;

  return str.replace(regex, "").trim();
};

export const copyTitle = (mainTitle, sameTitle) => {
  if (sameTitle.length > 1) {
    return `${mainTitle} copy_${sameTitle.length}`;
  } else {
    return mainTitle + " copy";
  }
};

export const validateInput = (value, regex) => {
  if (value === "") {
    return false;
  } else if (regex.test(value)) {
    return false;
  } else {
    return true;
  }
};

export const validateStringFormat = (input) => {
  const pattern = /^(\w+:\s*[\w\d\-]+)(,\s*\w+:\s*[\w\d\-]+)*$/;
  return pattern.test(input);
};
