#include <QCoreApplication>
#include "camera.h"
#include "QtWebSockets/qwebsocketserver.h"
#include "QtWebSockets/qwebsocket.h"

int main(int argc, char *argv[])
{
    QCoreApplication a(argc, argv);

    Camera Camera;

    return a.exec();
}
