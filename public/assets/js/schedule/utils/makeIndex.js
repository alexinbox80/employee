import getDateOfMonth from "./getDateOfMonth.js";
import getIndex from "./getIndex.js";

export default (employeeId, date) => getIndex(employeeId, getDateOfMonth(date));
