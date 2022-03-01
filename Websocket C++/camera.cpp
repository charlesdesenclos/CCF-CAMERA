#include "camera.h"
#include <QDebug>
#include <QSettings>

Camera::Camera(QObject *parent)
{

// Link to file camera.ini
    QSettings settings("/home/debian/Camera/camera.ini",
                       QSettings::IniFormat);

// Get Values from camera.ini
QString IPMoxa = settings.value("IPMoxa").toString();

qDebug() <<  "IP Moxa = " << IPMoxa;

quint16 PortMoxa = settings.value("PortMoxa").toInt();

qDebug() <<  "Port Moxa = " << PortMoxa;

quint16 PortWebSocket = settings.value("PortWebSocket").toInt();

qDebug() <<  "Port WebSocket = " << PortWebSocket;


// Web Socket Configuration
webSocketServer = new QWebSocketServer(QStringLiteral("WebServer"), QWebSocketServer::NonSecureMode, this);


connect(webSocketServer, &QWebSocketServer::newConnection, this, &Camera::newWebConnexion);
    webSocketServer->listen(QHostAddress::AnyIPv4, PortWebSocket);

// Camera socket configuration
socket = new QTcpSocket(this);
connect(socket, &QTcpSocket::connected, this, &Camera::onSocketConnected);
    socket->connectToHost(IPMoxa, PortMoxa);

}


void Camera::onSocketConnected()
{

    qDebug() << "Socket connected";
}

void Camera::newWebConnexion()
{
    QWebSocket *webClient = webSocketServer->nextPendingConnection();
    qDebug() << "WebServer connexion ok";
    QObject::connect(webClient, &QWebSocket::disconnected, this, &Camera::webSocketDisonnected);
    QObject::connect(webClient, &QWebSocket::textMessageReceived, this, &Camera::processTextMessage);
}

void Camera::webSocketDisonnected()
{
    this->obj = qobject_cast<QWebSocket *>(sender());
    this->obj->deleteLater();
    qDebug() << "WebSocket client disconnected";
}

void Camera::processTextMessage(QString message)
{
    this->obj = qobject_cast<QWebSocket *>(sender());
    QString data = message;

    qDebug() << message;

    if(data == "camOn") {
        camOn();
    }

    if(data == "camOff") {
        camOff();
    }

    if(data == "moveUp") {
        camUp();
    }

    if(data == "moveDown") {
        camDown();
    }

    if(data == "moveRight") {
        camRight();
    }

    if(data == "moveLeft") {
        camLeft();
    }

    if(data == "movementStop") {
        camMovementStop();
    }

    if(data == "moveReset") {
        camPositionReset();
    }

    if(data == "zoomMin") {
        camZoomMin();
    }

    if(data == "zoomMax") {
        camZoomMax();
    }

    if(data == "zoomStop") {
        camZoomStop();
    }
}

void Camera::camOn() {
    // Convert string to hex
    QByteArray data = QByteArray::fromHex("81 01 04 00 02 FF");

    // Send data to issue function
    issue(data);
}

void Camera::camOff() {
    // Convert string to hex
    QByteArray data = QByteArray::fromHex("81 01 04 00 03 FF");

    // Send data to issue function
    issue(data);

}

void Camera::camUp() {
    // Convert string to hex
    QByteArray data = QByteArray::fromHex("81 01 06 01 07 07 03 01 FF");

    // Send data to issue function
    issue(data);

}

void Camera::camDown() {
    // Convert string to hex
    QByteArray data = QByteArray::fromHex("81 01 06 01 10 10 03 02 FF");

    // Send data to issue function
    issue(data);

}

void Camera::camLeft() {
    // Convert string to hex
    QByteArray data = QByteArray::fromHex("81 01 06 01 09 14 01 03 FF");

    // Send data to issue function
    issue(data);

}

void Camera::camRight() {
    // Convert string to hex
    QByteArray data = QByteArray::fromHex("81 01 06 01 10 10 02 03 FF");

    // Send data to issue function
    issue(data);

}

void Camera::camPositionReset() {
    // Convert string to hex
    QByteArray data = QByteArray::fromHex("81 01 06 02 08 08 0Y 0Y 0Y 0Y 0Z 0Z 0Z 0Z FF");

    // Send data to issue function
    issue(data);

}

void Camera::camMovementStop() {
    // Convert string to hex
    QByteArray data = QByteArray::fromHex("81 01 06 01 08 08 03 03 FF");

    // Send data to issue function
    issue(data);

}

void Camera::camZoomMin() {
    // Convert string to hex
    QByteArray data = QByteArray::fromHex("81 01 04 07 03 FF");

    // Send data to issue function
    issue(data);

}

void Camera::camZoomMax() {
    // Convert string to hex
    QByteArray data = QByteArray::fromHex("81 01 04 07 02 FF");

    // Send data to issue function
    issue(data);

}

void Camera::camZoomStop() {
    // Convert string to hex
    QByteArray data = QByteArray::fromHex("81 01 04 07 00 FF");

    // Send data to issue function
    issue(data);

}

void Camera::issue(QByteArray data)
{
    socket->write(data);
    socket->flush();
}
