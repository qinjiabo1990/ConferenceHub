import React, {Component} from 'react';
import {View, StyleSheet, Button} from 'react-native';
import MapView, { Marker } from 'react-native-maps';
import { OpenMapDirections } from 'react-native-navigation-directions';

export default class Location extends Component {
    static navigationOptions= ({navigation}) =>({
        title: 'Map',
        headerRight: <View />,
    });

    state={
        data:[],
    };

    fetchData = async() =>{
        const {params} = this.props.navigation.state;
        const response =  await fetch('https://infs3202-17f1ea70.uqcloud.net/app/other_info.php',{
            method:'post',
            header:{
                'Accept': 'application/json',
                'Content-type': 'application/json'
            },
            body:JSON.stringify({
                ID: params.id,
            })
        });
        const products = await response.json(); // products have array data
        this.setState({data: products}); // filled data with dynamic array
    };

    componentDidMount() {
        this.fetchData();
    }

    _callShowDirections = () => {
        this.state.data.map((item, key) => {
            const startPoint = {
                longitude: null,
                latitude: null
            };

            const endPoint = {
                longitude: parseFloat(item.Info_Longitude),
                latitude: parseFloat(item.Info_Latitude),
            };

            const transportPlan = 'w';

            OpenMapDirections(startPoint, endPoint, transportPlan).then(res => {
                console.log(res)
            });
        })
    };

    render() {
        return (
            <View style={styles.container}>
                {
                    this.state.data.map((item, key) =>
                        <MapView style={styles.map}
                                 provider={'google'}
                                 key={key}
                                 showsUserLocation={true}
                                 showsMyLocationButton={true}
                                 region={{
                            latitude: parseFloat(item.Info_Latitude),
                            longitude: parseFloat(item.Info_Longitude),
                            latitudeDelta: parseFloat(item.Info_LatitudeDelta),
                            longitudeDelta: parseFloat(item.Info_LongitudeDelta),
                        }}>

                            <Marker
                                coordinate={{latitude:parseFloat(item.Info_Latitude),
                                    longitude: parseFloat(item.Info_Longitude),}}
                            title={"title"}
                            description={"description"}
                            />
                        </MapView>
                    )
                }
                <Button
                    title='Navigation'
                    onPress={() => { this._callShowDirections() }}
                    color='#0000ff'
                />
            </View>
        );
    }
}

const styles = StyleSheet.create({
    container: {
        position: 'absolute',
        top: 0,
        left: 0,
        bottom: 0,
        right: 0,
        justifyContent: 'flex-end',
        alignItems: 'center'
    },
   map: {
        position: 'absolute',
        top: 0,
        left: 0,
        bottom: 0,
        right: 0,
    },
})