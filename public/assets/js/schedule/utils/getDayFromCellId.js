export default (cellId) => cellId - Math.trunc(cellId/100) * 100;
