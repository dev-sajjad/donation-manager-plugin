import { Message } from "element-ui";

// Default failure handler
const onFailDefault = (xhr) => {
  let err_msg = "An error occurred during the AJAX request.";
  if (xhr && xhr.responseText) {
    try {
      const res = JSON.parse(xhr.responseText);
      err_msg = res.data?.message || res.data?.error || err_msg;
    } catch (e) {
      console.error("Error parsing JSON response:", e);
    }
  }

  Message({
    message: `AJAX Request Failed - ${err_msg}`,
    type: "error",
    showClose: true,
    duration: 5000,
  });
};

// Default callback handler
const callbackDefault = (data) => {
  console.log("No callback defined. Dumping data in console.");
  console.debug(data);
};

// GET AJAX Request using XHR
export const getAJAX = (
  action,
  payload = {},
  callback = callbackDefault,
  onFail = onFailDefault
) => {
  const prefix = "dm"; // Use 'dm' for Donation Manager
  payload.action = `${prefix}_${action}`;
  payload._ajax_nonce = donationManagerAdmin.nonce;

  const urlParams = new URLSearchParams(payload).toString();
  const url = `${donationManagerAdmin.ajax_url}?${urlParams}`;

  const xhr = new XMLHttpRequest();
  xhr.open("GET", url, true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      // 4 = request finished and response is ready
      if (xhr.status >= 200 && xhr.status < 300) {
        try {
          const response = JSON.parse(xhr.responseText);
          callback(response);
        } catch (error) {
          console.error("Error parsing response:", error);
          onFail(xhr);
        }
      } else {
        onFail(xhr);
      }
    }
  };
  xhr.send();
};

// POST AJAX Request using XHR
export const postAJAX = (
  action,
  payload = {},
  callback = callbackDefault,
  onFail = onFailDefault
) => {
  const prefix = "dm"; // Use 'dm' for Donation Manager
  payload.action = `${prefix}_${action}`;
  payload._ajax_nonce = donationManagerAdmin.nonce;

  const xhr = new XMLHttpRequest();
  xhr.open("POST", donationManagerAdmin.ajax_url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      // 4 = request finished and response is ready
      if (xhr.status >= 200 && xhr.status < 300) {
        try {
          const response = JSON.parse(xhr.responseText);
          callback(response);
        } catch (error) {
          console.error("Error parsing response:", error);
          onFail(xhr);
        }
      } else {
        onFail(xhr);
      }
    }
  };

  const formParams = new URLSearchParams(payload).toString();
  xhr.send(formParams);
};
